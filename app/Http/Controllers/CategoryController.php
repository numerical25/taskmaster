<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //

    public function index() {
        try {
            $response = Category::all();
            return $response;
        } catch (\Exception $e) {
            return response()->json(['message'=> $e->getMessage()]);
        }
    }

    public function search(Request $request) {
        try {
            $name = $request->query('name');
            $response = Category::where('name','LIKE', `%{$name}%`)->get();
            return $response;
        }catch (\Exception $e) {
            return response()->json(['message'=> $e->getMessage()]);
        }
    }
}
