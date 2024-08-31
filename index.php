<?php
$cacheFilename = 'cache.json';
if(!file_exists($cacheFilename)) {
    $xml = simplexml_load_file('items.xml');

    // $items = $xml->xpath('/items/item/property[@name="Tags" and contains(@value, "axe")]/..');
    $items = $xml->xpath('/items/item/property[@name="EconomicValue"]/..');
    
    $itemsFiltered = [];
    foreach($items as $item)
    {
        $name = (string) $item['name'];
        $economicValue = (string) $item->xpath('property[@name="EconomicValue"]/@value')[0]['value'];
        $itemsFiltered[$name] = ['economicValue' => $economicValue, 'locale' => ['code' => $name]];
    }
    
    $localizationResource = fopen('Localization.txt', 'r');
    
    $linesCount = 1;
    $lines[1] = fgetcsv($localizationResource, 1000);
    $keyPos = 0;
    $frenchPos = array_search('french', $lines[1]);
    $englishPos = array_search('english', $lines[1]);
    
    while(($line = fgetcsv($localizationResource)) !== false)
    {
        $linesCount++;
    
        $key = $line[$keyPos];
    
        if(isset($itemsFiltered[$key])) {
            $itemsFiltered[$key]['locale']['fr'] = $line[$frenchPos];
            $itemsFiltered[$key]['locale']['en'] = $line[$englishPos];
        }
    }
    
    fclose($localizationResource);
} else {
    $itemsFiltered = json_decode(file_get_contents($cacheFilename), true);
}

$items = $itemsFiltered;

echo '</div>';

require_once('templates/home.php');

if(!file_exists($cacheFilename)) file_put_contents($cacheFilename, json_encode($itemsFiltered));