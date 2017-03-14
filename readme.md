# php-isbn

This library provides utilities function to call ISBN Databases

[![Build Status](https://travis-ci.org/hugsbrugs/php-isbn.svg?branch=master)](https://travis-ci.org/hugsbrugs/php-isbn)
[![Coverage Status](https://coveralls.io/repos/github/hugsbrugs/php-isbn/badge.svg?branch=master)](https://coveralls.io/github/hugsbrugs/php-isbn?branch=master)

## Install

Install package with composer
```
composer require hugsbrugs/php-isbn
```

In your PHP code, load library
```php
require_once __DIR__ . '/../vendor/autoload.php';
use Hug\Isbn\Isbn as Isbn;
```

## Usage

Default ISBN request call uses Google as provider
```php
$Isbn = new Isbn('0061234001', $provider = 'google');
echo '<pre>';print_r($Isbn->data);echo '</pre>';
```
Outputs

```php
[status] => success
[message] => 
[data] => Array
    (
        [0] => Array
            (
                [kind] => books#volume
                [id] => 9O6-UWVfDP0C
                [etag] => zLvABMcmx20
                [selfLink] => https://www.googleapis.com/books/v1/volumes/9O6-UWVfDP0C
                [volumeInfo] => Array
                    (
                        [title] => Freakonomics Rev Ed
                        [subtitle] => A Rogue Economist Explores the Hidden Side of Everything
                        [authors] => Array
                            (
                                [0] => Steven D. Levitt
                                [1] => Stephen J. Dubner
                            )

                        [publisher] => Harper Collins
                        [publishedDate] => 2006-10-17
                        [description] => Which is more dangerous, a gun or a swimming pool? What do schoolteachers and sumo wrestlers have in common? Why do drug dealers still live with their moms? How much do parents really matter? How did the legalization of abortion affect the rate of violent crime? These may not sound like typical questions for an econo-mist to ask. But Steven D. Levitt is not a typical economist. He is a much-heralded scholar who studies the riddles of everyday life—from cheating and crime to sports and child-rearing—and whose conclusions turn conventional wisdom on its head. Freakonomics is a groundbreaking collaboration between Levitt and Stephen J. Dubner, an award-winning author and journalist. They usually begin with a mountain of data and a simple question. Some of these questions concern life-and-death issues; others have an admittedly freakish quality. Thus the new field of study contained in this book: freakonomics. Through forceful storytelling and wry insight, Levitt and Dubner show that economics is, at root, the study of incentives—how people get what they want, or need, especially when other people want or need the same thing. In Freakonomics, they explore the hidden side of . . . well, everything. The inner workings of a crack gang. The truth about real-estate agents. The myths of campaign finance. The telltale marks of a cheating schoolteacher. The secrets of the Klu Klux Klan. What unites all these stories is a belief that the modern world, despite a great deal of complexity and downright deceit, is not impenetrable, is not unknowable, and—if the right questions are asked—is even more intriguing than we think. All it takes is a new way of looking. Freakonomics establishes this unconventional premise: If morality represents how we would like the world to work, then economics represents how it actually does work. It is true that readers of this book will be armed with enough riddles and stories to last a thousand cocktail parties. But Freakonomics can provide more than that. It will literally redefine the way we view the modern world.
                        [industryIdentifiers] => Array
                            (
                                [0] => Array
                                    (
                                        [type] => ISBN_13
                                        [identifier] => 9780061234002
                                    )

                                [1] => Array
                                    (
                                        [type] => ISBN_10
                                        [identifier] => 0061234001
                                    )

                            )

                        [readingModes] => Array
                            (
                                [text] => 
                                [image] => 
                            )

                        [pageCount] => 336
                        [printType] => BOOK
                        [categories] => Array
                            (
                                [0] => Business & Economics
                            )

                        [averageRating] => 3.5
                        [ratingsCount] => 3708
                        [maturityRating] => NOT_MATURE
                        [allowAnonLogging] => 
                        [contentVersion] => preview-1.0.0
                        [imageLinks] => Array
                            (
                                [smallThumbnail] => http://books.google.com/books/content?id=9O6-UWVfDP0C&printsec=frontcover&img=1&zoom=5&source=gbs_api
                                [thumbnail] => http://books.google.com/books/content?id=9O6-UWVfDP0C&printsec=frontcover&img=1&zoom=1&source=gbs_api
                            )

                        [language] => en
                        [previewLink] => http://books.google.fr/books?id=9O6-UWVfDP0C&dq=isbn:0061234001&hl=&cd=1&source=gbs_api
                        [infoLink] => http://books.google.fr/books?id=9O6-UWVfDP0C&dq=isbn:0061234001&hl=&source=gbs_api
                        [canonicalVolumeLink] => http://books.google.fr/books/about/Freakonomics_Rev_Ed.html?hl=&id=9O6-UWVfDP0C
                    )

                [saleInfo] => Array
                    (
                        [country] => FR
                        [saleability] => NOT_FOR_SALE
                        [isEbook] => 
                    )

                [accessInfo] => Array
                    (
                        [country] => FR
                        [viewability] => NO_PAGES
                        [embeddable] => 
                        [publicDomain] => 
                        [textToSpeechPermission] => ALLOWED
                        [epub] => Array
                            (
                                [isAvailable] => 
                            )

                        [pdf] => Array
                            (
                                [isAvailable] => 
                            )

                        [webReaderLink] => http://books.google.fr/books/reader?id=9O6-UWVfDP0C&hl=&printsec=frontcover&output=reader&source=gbs_api
                        [accessViewStatus] => NONE
                        [quoteSharingAllowed] => 
                    )

                [searchInfo] => Array
                    (
                        [textSnippet] => Offers an alternative view of how the economy really works, examining issues from cheating and crime to sports and child-rearing.
                    )

            )

    )
```

Use can alternatively use ISBNDB as provider
```php
$Isbn = new Isbn('0061234001', $provider = 'isbndb', $isbndb_key = 'YOUR_KEY');
echo '<pre>';print_r($Isbn->data);echo '</pre>';
```
Outputs
```php
[status] => success
[message] => 
[data] => Array
    (
        [0] => Array
            (
                [book_id] => freakonomics_rev_ed
                [isbn] => 0061234001
                [isbn13] => 9780061234002
            )

        [1] => Freakonomics
        [2] => Freakonomics: a rogue economist explores the hidden side of everything
        [3] => Steven D. Levitt and Stephen J. Dubner
        [4] => New York : William Morrow, c2006.
        [5] => Array
            (
                [@attributes] => Array
                    (
                        [change_time] => 2009-01-03T23:53:46Z
                        [price_time] => 2013-02-11T06:20:57Z
                        [edition_info] => 
                        [language] => eng
                        [physical_description_text] => xv, 320 p. ; 24 cm.
                        [lcc_number] => 
                        [dewey_decimal_normalized] => 330.2
                        [dewey_decimal] => 330.2
                    )

            )

    )
```

## Unit Tests

```
composer exec phpunit
```