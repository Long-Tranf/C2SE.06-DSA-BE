<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Tracking;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getData()
    {
        $data = Post::with(['association:id,registrant_name', 'category:id,category_name'])->get();

        return response()->json([
            'posts'  =>  $data
        ]);
    }
    public function getPostById($id)
    {
        $post = Post::with('association:id,registrant_name,avatar,company_name', 'category:id,category_name')->findOrFail($id);
                        
        return response()->json([
            'post' => $post
        ]);
    }
    public function store(PostRequest $request)
    {
        $data   =   $request->all();
        Post::create($data);

        return response()->json([
            'status'    =>  true,
            'message'   =>  'Đã tạo mới bài viết thành công!'
        ]);
    }
    public function destroy($id)
    {
        Post::find($id)->delete();

        return response()->json([
            'status'    =>  true,
            'message'   =>  'Đã xoá bài viết thành công!'
        ]);
    }
    public function update(Request $request)
    {
        $data   = $request->all();
        Post::find($request->id)->update($data);
        return response()->json([
            'status'    =>  true,
            'message'   =>  'Đã cập nhật bài viết thành công!'
        ]);
    }
    public function getTotalPosts()
    {
        $totalPosts = Post::count();

        return response()->json([
            'status' => true,
            'total_posts' => $totalPosts,
            'message' => 'Tổng số lượng bài viết'
        ]);
    }
    public function xemBaiViet($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json(['message' => 'Bài viết không tồn tại']);
        }
        $post->increment('view');
        return response()->json([
            'message' => 'Lượt xem đã được cập nhật',
            'view' => $post->view,
        ]);
    }
    public function latest()
    {
        $latestPost = Post::orderBy('created_at', 'desc')->first();
        if ($latestPost) {
            return response()->json($latestPost, 200);
        } else {
            return response()->json([
                'message' => 'Không có bài viết này!'
            ]);
        }
    }
    public function getTopPostsExcludingCurrent($id)
    {
    
        $currentPost = Post::findOrFail($id);
        $topPosts = Post::where('category_id', $currentPost->category_id)
                        ->where('id', '!=', $id)
                        ->orderBy('view', 'desc')
                        ->take(3)                 
                        ->get();

        return response()->json($topPosts);
    }
    public function search(Request $request)
    {
        $query = $request->input('q');
        $query = str_replace(' ', '%', $query);
        $posts = Post::where('title', 'LIKE', "%{$query}%")->get();

        return response()->json($posts, 200);
    }
    public function recommend(Request $request)
    {
        $query = $request->input('q');
        $query = str_replace(' ', '%', $query);

        $posts = Post::where('title', 'LIKE', "%{$query}%")
            ->select('id', 'title')
            ->take(3)
            ->get();

        return response()->json($posts, 200);
    }
    public function getTopPosts()
    {

        $topPosts = Post::orderBy('view', 'desc')->take(5)->get();

        return response()->json($topPosts);
    }
    public function getLatestPostsByCategory($category_id)
    {

        $latestPosts = Post::where('category_id', $category_id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return response()->json($latestPosts);
    }

    public function getPostsByMember($member_id)
    {
        $posts = Post::with([
            'association:id,registrant_name',
            'category:id,category_name',
        ])
        ->where('member_id', $member_id)
        ->get();
    
        return response()->json(['posts' => $posts]);
    }
    public function getLatestPosts()
    {
        $latestPosts = Post::orderBy('created_at', 'desc')->take(5)->get();

        return response()->json($latestPosts);
    }
    
}
