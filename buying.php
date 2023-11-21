<?php

$xml = simplexml_load_file('goods.xml');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  foreach ($xml->product as $product) {
    if ((int)$product->itemquantity  > 0) {
      echo '<tr>';
      echo '<td>' . $product->id . '</td>';
      echo '<td>' . $product->itemname . '</td>';
      echo '<td>' . $product->itemprice . '</td>';
      echo '<td>' . $product->itemquantity . '</td>';
      echo '<td>' . $product->itemdesc . '</td>';
      echo '<td><a href="#" class="add-to-cart" data-product-id="' . $product->id . '">Add one to the cart</a></td>';
      echo '</tr>';
    }
  }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
  if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];

    $targetProduct = null;
    foreach ($xml->product as $product) {
      if ((int)$product->id === (int)$productId) {
        $targetProduct = $product;
        break;
      }
    }

    if ($targetProduct !== null && (int)$targetProduct->itemquantity > 0) {
      
      $targetProduct->itemquantity = (int)$targetProduct->itemquantity - 1;
      $targetProduct->on_hold = (int)$targetProduct->on_hold + 1;

      
      $xml->asXML('goods.xml');

      
      echo json_encode(['success' => true, 'message' => 'Item added to the cart']);
    } else {
      
      echo json_encode(['success' => false, 'message' => 'Sorry, this item is not available for sale']);
    }
  } elseif (isset($_POST['removeProductId'])) {
    
    $removeProductId = $_POST['removeProductId'];

    $targetProduct = null;
    foreach ($xml->product as $product) {
      if ((int)$product->id === (int)$removeProductId) {
        $targetProduct = $product;
        break;
      }
    }

    if ($targetProduct !== null && (int)$targetProduct->on_hold > 0) {
      
      $targetProduct->itemquantity = (int)$targetProduct->itemquantity + (int)$targetProduct->on_hold;
      $targetProduct->on_hold = 0;

      
      $xml->asXML('goods.xml');

      
      echo json_encode(['success' => true, 'message' => 'Item removed from the cart']);
    } else {
      
      echo json_encode(['success' => false, 'message' => 'Failed to remove item from the cart']);
    }
  } else {
    
    echo json_encode(['success' => false, 'message' => 'Invalid request parameters']);
  }
} else {
  
  echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
