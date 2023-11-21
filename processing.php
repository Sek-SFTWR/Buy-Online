<?php
$xml = simplexml_load_file('goods.xml');

foreach ($xml->product as $product) {
    if ((int)$product->sold > 0) {
        
        $product->sold = 0;
    }
}

$xml->asXML('goods.xml');

echo json_encode(['success' => true]);
?>
