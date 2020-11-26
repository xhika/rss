<?php

declare(strict_types=1);
require_once __DIR__ .'/vendor/autoload.php';
#require_once __DIR__.'/src/App/View/index.view.php';




$linkA = 'https://www.buzzfeed.com/world.xml';
$linkB = 'https://www.nytimes.com/svc/collections/v1/publish/https://www.nytimes.com/section/world/rss.xml';


$channel = (array) addLink($linkB);

$channel2 = (array) addLink($linkA);


$res = sortByItem($channel2);

echo $res . "\r\n";



/**
 * Sort array after channel's items
 * 
 * @param   $channel    object
 * @return  $arrayOfTitles     array
 */
function sortByItem($channel) {
    foreach ($channel['item'] as $item) {

        // Make an array of an object
        $arrayOfItems = (array) $item;

        // Push title properties into new array.
        $arrayOfTitles[] = $arrayOfItems['title'];


        // Make comparesiment, sort if true
        usort($arrayOfTitles, 'compare');
    }

    $json =  json_encode($arrayOfTitles, JSON_PRETTY_PRINT);
    return $json;
}

/**
 * String comparisment
 * 
 * @param   $a & $b     string
 * @return  bool
 */
function compare($a, $b) 
{
    // dd($a, $b);
    return strcmp($a, $b);
}

/**
 *  Generate object of rss link
 * 
 * @param   $url        string
 * @return  $url        object 
 */
function addLink($url)
{
    $url = simplexml_load_file($url);
    return $url->channel;
}

