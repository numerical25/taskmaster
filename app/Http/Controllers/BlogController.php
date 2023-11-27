<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //

    public function index(Request $request) {
        $orderBy = $request->query('orderBy', 'created_at');
        $orderDirection = $request->query('orderDirection', 'asc');
        return Blog::orderBy($orderBy, $orderDirection)->paginate(10);
    }

    public function view($id)
    {
        try {
            return Blog::with('Owner')->find($id);
        } catch (\Exception $e) {
            response()->json(['message'=> 'Issue getting Product Details']);
        }
    }
}
