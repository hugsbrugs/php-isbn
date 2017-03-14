<?php

namespace Hug\Isbn;

/**
 *
 */
class Isbn
{
    public $isbn = null;
    public $provider = 'google';
    public $data = null;

    public $isbndb_key = null;

    /**
     *
     */
    function __construct($isbn = null, $provider = 'google', $isbndb_key = null)
    {
        $this->isbn = $isbn;
        $this->provider = $provider;
        $this->isbndb_key = $isbndb_key;
        
        if($this->isbn!==null && $this->provider!==null)
        {
            $this->load();
        }
    }

    /**
     *
     */
    public function load()
    {
        switch ($this->provider)
        {
            case 'google':
                $this->load_google();
                break;
            case 'isbndb':
                if($this->isbndb_key!==null)
                {
                    $this->load_isbndb();
                }
                else
                {
                    $this->data = [
                        'status' => 'error', 
                        'message' => 'MISSING_ISBNDB_KEY', 
                        'data' => null
                    ];    
                }
                break;
            default:
                $this->data = [
                    'status' => 'error', 
                    'message' => 'UNKNOWN_ISBN_PROVIDER', 
                    'data' => null
                ];
                break;
        }
    }

    /**
     * Load Isbn from Google data Source
     */
    public function load_google()
    {
        $response = ['status' => 'error', 'message' => '', 'data' => null];

        $request = 'https://www.googleapis.com/books/v1/volumes?q=isbn:' . $this->isbn;
        $isbns = file_get_contents($request);
        if($isbns!==false)
        {
            $results = json_decode($isbns, true);  
            if($results!==null)
            {
                //echo '<pre>';print_r($results);echo '</pre><br><br>';
                if($results['totalItems'] > 0)
                {
                    $response['data'] = [];
                    // $count_books = count($results->totalItems);
                    // for($i = 0; $i < $count_books; $i++)
                    foreach ($results['items'] as $book)
                    {
                        $response['data'][] = $book;

                        //$book = $results->items[$i];
                        // avec de la chance, ce sera le 1er trouvé  
                        //$book = $results->items[0];  
                      
                        /*$infos['isbn'] = $book->volumeInfo->industryIdentifiers[0]->identifier;  
                        $infos['titre'] = $book->volumeInfo->title;  
                        $infos['auteur'] = $book->volumeInfo->authors[0];  
                        $infos['langue'] = $book->volumeInfo->language;  
                        $infos['publication'] = $book->volumeInfo->publishedDate;  
                        $infos['pages'] = $book->volumeInfo->pageCount;  
                        if( isset($book->volumeInfo->imageLinks) )
                        {  
                           $infos['image'] = str_replace('&edge=curl', '', $book->volumeInfo->imageLinks->thumbnail);  
                        }  
                        $response['data'][] = $infos;*/
                    }
                    $response['status'] = 'success';
                }
                else
                {
                   $response['message'] = 'ISBN_NOT_FOUND';
                }
            }
            else
            {
                $response['message'] = 'ERROR_DECODING_DATA';
            }
        }
        else
        {
            $response['message'] = 'ERROR_FETCHING_DATA';
            # Send mail to admin ,
        }

        //echo '<pre>';print_r($response);echo '</pre>';
        $this->data = $response;
    }

    /**
     * Load Isbn from ISBN DB data Source
     */
    public function load_isbndb()
    {
        $response = ['status' => 'error', 'message' => '', 'data' => null];

        // create url
        $url = 'http://isbndb.com/api/books.xml?access_key='.$this->isbndb_key.'&results=details&index1=isbn&value1='.$this->isbn;

        // load url into $isbns
        $isbns = simplexml_load_file($url);

        if($isbns!==false)
        {
           //$isbns = (array)$isbns;
           $isbns = json_decode(json_encode((array)$isbns), true);
           //echo '<pre>';print_r($isbns);echo '</pre><br><br>';

           if($isbns['BookList']['@attributes']['total_results'] > 0)
           {
              $response['data'] = [];

              // assign each book to $book
              foreach($isbns['BookList']['BookData'] as $book)
              {
                 $response['data'][] = $book;

                 // echo "Short Title: {$book->Title}<br/>
                 // Long Title: {$book->TitleLong}<br/>
                 // Author(s): {$book->AuthorsText}<br />
                 // Publisher: {$book->PublisherText}<br/>
                 // ISBN10: {$book['isbn']}<br/>
                 // ISBN13: {$book['isbn13']}<br/>
                 // Edition Information: {$book->Details['edition_info']}<br/>
                 // Language: {$book->Details['language']}<br/>
                 // Physical Description: {$book->Details['physical_description_text']}
                 // ";
              }
              $response['status'] = 'success';
           }
           else
           {
              $response['message'] = 'ISBN_NOT_FOUND';
           }
        }
        else
        {
           $response['message'] = 'ERROR_FETCHING_DATA';
        }

        $this->data = $response;
        //echo '<pre>';print_r($response);echo '</pre>';
    }

}
