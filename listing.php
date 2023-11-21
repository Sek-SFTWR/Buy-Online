<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itemname = $_POST['itemname'];
    $itemprice = $_POST['itemprice'];
    $itemquantity = $_POST['itemquantity'];
    $itemdesc = $_POST['itemdesc'];


    // Load XML file
    $xml = simplexml_load_file('goods.xml');

   
    $productId = count($xml->xpath('//product')) + 1;
    $on_hold=0;
    $sold=0;
    // proceed with registration
    $newProduct = $xml->addChild('product');
    $newProduct->addChild('id', $productId);
    $newProduct->addChild('itemname', $itemname);
    $newProduct->addChild('itemprice', $itemprice);
    $newProduct->addChild('itemquantity', $itemquantity);
    $newProduct->addChild('itemdesc', $itemdesc);
    $newProduct->addChild('on_hold', $on_hold);
    $newProduct->addChild('sold', $sold);

    $xml->asXML('goods.xml');

    echo json_encode(['success' => true, 'message' => 'The item has been listed in the system. Item number is: '.$productId.' (^__^) ']);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
