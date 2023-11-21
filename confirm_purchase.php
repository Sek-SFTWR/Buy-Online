<?php

$xml = simplexml_load_file('goods.xml');
$totalAmount = 0;

foreach ($xml->product as $product) {
  if ((int)$product->on_hold > 0) {
  
    $quantityOnHold = (int)$product->on_hold;
    $product->itemquantity = (int)$product->itemquantity - $quantityOnHold;
    $product->sold = (int)$product->sold + $quantityOnHold;

    
    $product->on_hold = 0;

    
    $totalAmount += (int)$product->itemprice * $quantityOnHold;
  }
}


$xml->asXML('goods.xml');

echo json_encode(['success' => true, 'totalAmount' => $totalAmount]);
?>
