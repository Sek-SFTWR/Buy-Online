<?php
// Load goods.xml
$xml = simplexml_load_file('goods.xml');
$totalprice = 0;
$html = '';

foreach ($xml->product as $product) {
  if ((int)$product->on_hold > 0) {
    $html .= '<tr>';
    $html .= '<td>' . $product->id . '</td>';
    $html .= '<td>' . $product->itemname . '</td>';
    $html .= '<td>' . $product->itemprice . '</td>';
    $html .= '<td>' . $product->on_hold . '</td>';
    $html .= '<td><a href="#" class="remove-from-cart" data-product-id="' . $product->id . '">Remove from cart</a></td>';
    $html .= '</tr>';
    $totalprice += (int)$product->itemprice * (int)$product->on_hold;
  }
}

echo json_encode(['cartHtml' => $html, 'totalPrice' => $totalprice]);
?>
