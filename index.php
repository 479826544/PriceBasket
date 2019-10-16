<?php
include('model/priceBasket.php');

use model\PriceBasket;

function priceBasket($test)
{
    //Reference test data
    $test_array = include('test/' . $test . '.php');

    $priceBasket = PriceBasket::getInstance();
    $result = $priceBasket->settle_accounts($test_array);
    echo 'Subtotal: $' . $result['total_normal_price'] . '<br>';
    foreach ($result['msg'] as $v) {
        echo $v . '<br>';
    }
    echo 'Total: $' . $result['total_discount_price'];
}

$_GET['test'] = empty($_GET['test']) ? 'test_one' : $_GET['test'];
priceBasket($_GET['test']);