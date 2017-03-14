<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Hug\Isbn\Isbn as Isbn;

$isbns = [
	'0061234001',
	'9782845674608',
	'2070643026',
];
$isbndb_key = 'YOUR_KEY';

# TEST GOOGLE PROVIDER
foreach ($isbns as $isbn)
{
	$Isbn = new Isbn($isbn, 'google');
	echo 'Results for ' . $isbn . ' / google : <br>';
	echo '<pre>';print_r($Isbn->data);echo '</pre>';
}

if($isbndb_key!=='' && $isbndb_key!=='YOUR_KEY')
{
	# TEST ISBNDB PROVIDER
	foreach ($isbns as $isbn)
	{
		$Isbn = new Isbn($isbn, 'isbndb', $isbndb_key);
		echo 'Results for ' . $isbn . ' / isbndb : <br>';
		echo '<pre>';print_r($Isbn->data);echo '</pre>';
	}
}