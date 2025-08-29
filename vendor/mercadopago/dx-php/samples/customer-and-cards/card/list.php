<?php
    require_once dirname(__FILE__) . '/../../index.php';
    
    $cards = MercadoPago\Card::all(array("customer_id" => "0000000000-zk2BeFiet6otYD"));
    echo 'Card id: ' . $cards[0]->id;
?>
