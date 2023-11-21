<?php
$xml = simplexml_load_file('goods.xml');

$html = '';

foreach ($xml->product as $product) {
    if ((int)$product->sold > 0) {
        $html .= '<tr>';
        $html .= '<td>' . $product->id . '</td>';
        $html .= '<td>' . $product->itemname . '</td>';
        $html .= '<td>' . $product->itemprice . '</td>';
        $html .= '<td>' . $product->itemquantity . '</td>';
        $html .= '<td>' . $product->on_hold . '</td>';
        $html .= '<td>' . $product->sold . '</td>';
        $html .= '</tr>';
    }
}

echo $html;
?>
