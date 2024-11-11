<?php 

/*Install Midtrans PHP Library (https://github.com/Midtrans/midtrans-php)
composer require midtrans/midtrans-php
                              
Alternatively, if you are not using **Composer**, you can download midtrans-php library 
(https://github.com/Midtrans/midtrans-php/archive/master.zip), and then require 
the file manually.   

require_once dirname(__FILE__) . '/pathofproject/Midtrans.php'; */
require_once dirname(__FILE__) . '/midtrans-php-master/Midtrans.php';

// Debugging: Memeriksa isi $_POST
// var_dump($_POST);

//SAMPLE REQUEST START HERE

// Set your Merchant Server Key
\Midtrans\Config::$serverKey = 'SB-Mid-server-Ymf8XT9wcmWWtimE1GWPAzFw';
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = false;
// Set sanitization on (default)
\Midtrans\Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds = true;

//? Dimatikan sementara
// $params = array(
//     'transaction_details' => array(
//         'order_id' => rand(),
//         'gross_amount' => $_POST['total'],
//     ),
//     'item_details' => json_decode($_POST['items'], true),
//     'customer_details' => array(
//         'first_name' => $_POST['name'],
//         'email' => $_POST['email'],
//         'phone' => $_POST['phone'],
//         'address' => $_POST['address']
//     ),
// );

// $snapToken = \Midtrans\Snap::getSnapToken($params); 
// echo $snapToken;

//? Versi Chatgpt
// Meng-decode JSON pada $_POST['items']
$items = json_decode($_POST['items'], true);

// Mengambil nilai total dari array items
$total = 0;
foreach ($items as $item) {
    $total += $item['total'];
}

$params = array(
    'transaction_details' => array(
        'order_id' => rand(),
        'gross_amount' => $total, // Gunakan $total yang dihitung dari item
    ),
    'item_details' => $items,
    'customer_details' => array(
        'first_name' => $_POST['name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'address' => $_POST['address']
    ),
);

$snapToken = \Midtrans\Snap::getSnapToken($params); 
echo $snapToken;

?>