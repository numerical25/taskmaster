<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SiteCategory;
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

    public function create(Request $request) {
        try {
            $data = $request->all();
            $response = Category::updateOrCreate(['name' => $data['name']], $data);
            $siteCategory = ['child_id' => $response->id];
            $response = SiteCategory::updateOrCreate(['child_id' => $response->id], $siteCategory);
            return $this->index();
        } catch (\Exception $e) {
            return response()->json(['message'=> $e->getMessage()]);
        }
    }
}
