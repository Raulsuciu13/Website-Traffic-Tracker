<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ProductController extends BaseController
{
    public function index($id)
    {
        if(!$id || !in_array($id, [1, 2, 3, 4])) {
            abort(404);
        }

        if($id == 1) {
            $product = [
                'name' => 'Organize Basic Set (Walnut)',
                'image' => 'https://tailwindui.com/img/ecommerce-images/category-page-05-image-card-01.jpg',
                'price' => 15,
                'reviews' => 38,
                'reviewCount' => 5
            ];
        } elseif($id == 2) {
            $product = [
                'name' => 'Organize Pen Holder',
                'image' => 'https://tailwindui.com/img/ecommerce-images/category-page-05-image-card-02.jpg',
                'price' => 15,
                'reviews' => 18,
                'reviewCount' => 5
            ];
        } elseif($id == 3) {
            $product = [
                'name' => 'Organize Sticky Note Holder',
                'image' => 'https://tailwindui.com/img/ecommerce-images/category-page-05-image-card-03.jpg',
                'price' => 15,
                'reviews' => 14,
                'reviewCount' => 5
            ];
        } elseif($id == 4) {
            $product = [
                'name' => 'Organize Phone Holder',
                'image' => 'https://tailwindui.com/img/ecommerce-images/category-page-05-image-card-04.jpg',
                'price' => 15,
                'reviews' => 21,
                'reviewCount' => 4
            ];
        }

        return view('product', ['product' => $product]);
    }
}
