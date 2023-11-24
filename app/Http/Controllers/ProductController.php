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

    public function detail($id)
    {
        try {
            return Product::find($id);
        } catch (\Exception $e) {
            response()->json(['message'=> 'Issue getting Product Details']);
        }
    }
}
