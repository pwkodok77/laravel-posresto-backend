<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //index api
    public function index(){
        $products = Product::paginate(10);
        return response()-json([
            'status' => 'success',
            'data' => $products
        ], 200);
    }
}
