<?php

$xml = simplexml_load_file('items.xml');

// $items = $xml->xpath('/items/item/property[@name="Tags" and contains(@value, "axe")]/..');
$items = $xml->xpath('/items/item/property[@name="EconomicValue"]/..');

$items = array_map(fn($item) => ['name' => (string) $item['name'], 'economicValue' => (string) $item->xpath('property[@name="EconomicValue"]/@value')[0]['value']], $items);
// var_dump($items);

echo '<div style="max-width: 900px; margin-inline: auto;">';
echo '<h1>Items et leurs prix : </h1>';

foreach($items as $item)
{
    echo '<div>';
    echo '<p>Nom de l\'item : ' . $item['name'] . '</p>';
    echo '<p>Prix de base de l\'item : ' . $item['economicValue'] . ' Dukes </p>';
    echo '</div>';
    echo '<hr>';
}

echo '</div>';
