<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_all_comments(): void
    {
        $response = $this->get('/api/comment');
        $data = json_decode($response->getContent());
        $response->assertStatus(200);
    }

    public function test_comments_by_content(): void
    {
        $contentId = Comment::pluck('content_id')->first();
        $response = $this->get("/api/comment/{$contentId}/list");
        $data = json_decode($response->getContent());
        $response->assertStatus(200);
    }
}
