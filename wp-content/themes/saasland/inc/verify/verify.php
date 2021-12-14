<?php
require_once('class.verify-purchase.php');
if (isset($_POST['saasland_purchase_code'] ) && isset($_POST['saasland_purchase_username'])){
    $purchase_code = htmlspecialchars($_POST['saasland_purchase_code']);
    $username = htmlspecialchars($_POST['saasland_purchase_username']);
    $o = EnvatoApi2::verifyPurchase( $purchase_code , $username );

    if ( is_object($o) ) {
        echo 'verified';
    } else {
        return '';
    }
}