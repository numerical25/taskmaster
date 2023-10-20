<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index(Request $request)
    {
        $orderBy = $request->query('orderBy', 'price');
        $orderDirection = $request->query('orderDirection', 'asc');
        return Product::orderBy($orderBy, $orderDirection)->paginate(10);
    }
}
