<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //

    public function index(Request $request) {
        try {
            $response = Comment::with('Owner')->get();
            return $response;
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function latest(Request $request) {
        try {
            $orderBy = $request->query('orderBy', 'created_at');
            $orderDirection = $request->query('orderDirection', 'asc');
            $response = Comment::with('Owner')
                ->orderBy($orderBy, $orderDirection)->get();
            return $response;
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function list( string $id) {
        try {
            $response = Comment::with(['Owner', 'CommentedOn'])->where('content_id', $id)->get();
            return $response;
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
}
