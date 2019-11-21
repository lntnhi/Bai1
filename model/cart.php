<?php 
include_once("model/productModel.php");
class Cart {
    static function priceOfOne($price, $quantity) {
        return $quantity * $price;
    }

    static function totalPrice($lsCart) {
        $sum = 0;
        foreach ($lsCart as $key => $value) {
            $product = Product::getProductByID($value->ID);
            $sum+=Cart::priceOfOne($product->price, $value->quantity);
        }
        return $sum;
    }

    static function existProduct($ID, $lsCart) {
        foreach ($lsCart as $key => $value) {
            if ($value->ID==$ID) return true;
        }
        return false;
    }

    static function updateQuantity($ID, $quantity, $lsCart) {
        foreach ($lsCart as $key => $value) {
            if ($value->ID==$ID) $value->quantity = $quantity;
        }
        return $lsCart;
    }

    static function addQuantity($ID, $quantity, $lsCart) {
        foreach ($lsCart as $key => $value) {
            if ($value->ID==$ID) $value->quantity += $quantity;
        }
        return $lsCart;
    }

    static function deleteProduct($ID, $lsCart) {
        foreach ($lsCart as $key => $value) {
            if ($value->ID==$ID) unset($lsCart[$key]);
        }
        return $lsCart;
    }
}
?>