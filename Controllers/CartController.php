<?php

class CartController
{
    public function index()
    {
        $cart = [

            [
                'name' => 'Nike Air Force 1',
                'price' => 2500000,
                'quantity' => 1,
                'image' => 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/air-force-1-07-shoes-WrLlWX.png'
            ],

            [
                'name' => 'Adidas Ultraboost',
                'price' => 3200000,
                'quantity' => 2,
                'image' => 'https://assets.adidas.com/images/w_600,f_auto,q_auto/ultraboost-shoes.jpg'
            ]

        ];



        require "views/pages/gio-hang.php";

    }
}