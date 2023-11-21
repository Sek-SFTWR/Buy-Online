<?php

$xml = simplexml_load_file('goods.xml');

foreach ($xml->product as $product) {
  if ((int)$product->on_hold > 0) {
    
    $product->itemquantity = (int)$product->itemquantity + (int)$product->on_hold;
    $product->on_hold = 0;
  }
}


$xml->asXML('goods.xml');

echo json_encode(['success' => true]);
?>
