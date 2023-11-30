<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SiteCategory;
use Illuminate\Http\Request;

class SiteCategoryController extends Controller
{
    //

    public function index() {
        try {
            $response = SiteCategory::with('Child.Children')->get();
            return $response;
        } catch (\Exception $e) {

        }
    }
}
