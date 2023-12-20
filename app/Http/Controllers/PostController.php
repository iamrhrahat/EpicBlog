<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostView;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Carbon\Carbon; // Add this import at the top of your file
use App\Models\Category;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home(): View
    {
        // Latest Post
        $latestPost = Post::where('active','=', 1)
        ->whereDate('published_at','<', Carbon::now())
        ->orderBy('created_at','desc')
        ->limit(1)
        ->first();

        // Show the most popular 3 posts based on upvotes
        $popularPosts = Post::query()
    ->leftJoin('upvote_downvotes', 'posts.id', '=', 'upvote_downvotes.post_id')
    ->select('posts.id', 'posts.title', 'posts.thumbnail', 'posts.body', DB::raw('COUNT(upvote_downvotes.id) as upvote_count'))
    ->where(function ($query) {
        $query->whereNull('upvote_downvotes.is_upvote')
            ->orWhere('upvote_downvotes.is_upvote', '=', 1);
    })
    ->where('active', '=', 1)
    ->whereDate('published_at', '<', Carbon::now())
    ->orderByDesc('upvote_count')
    ->groupBy([
        'posts.id',
        'posts.title',
        'posts.slug',
        'posts.thumbnail',
        'posts.body',
        'posts.active',
        'posts.published_at',
        'posts.user_id',
        'posts.created_at',
        'posts.updated_at',
        'posts.meta_title',
        'posts.meta_description',
    ])
    ->limit(5)
    ->get();



        // If authorised - Show recommended post based on user upvotes

        // If not authorised - popular posts based on views

        // Show recent categories with their latest post


        // $posts = Post::query()
        // ->where('active','=', 1)
        // ->whereDate('published_at', '<', Carbon::now())
        // ->orderBy('published_at', 'desc')
        // ->paginate(10);
         return view('home', compact('latestPost','popularPosts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */

    public function show(Post $post, Request $request )
    {
        if(!$post->active || $post->published_at > Carbon::now()){
            throw new NotFoundHttpException();
        }

        $next =Post::query()
            ->where('active', true)
            ->whereDate('published_at', '<', Carbon::now())
            ->whereDate('published_at', '<', $post->published_at)
            ->orderBy('published_at', 'desc')
            ->limit(1)
            ->first();

            $prev =Post::query()
            ->where('active', true)
            ->whereDate('published_at', '<', Carbon::now())
            ->whereDate('published_at', '>', $post->published_at)
            ->orderBy('published_at', 'asc')
            ->limit(1)
            ->first();

            $user = $request->user();
            PostView::create([
                'ip_address'=> $request->ip(),
                'user_agent'=> $request->userAgent(),
                'post_id'=> $post->id,
                'user_id' => $user?->id
            ]);

        return view('post.view', compact('post', 'prev', 'next'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function byCategory(Category $category)
    {
        $posts = Post::query()
        ->join('category_post', 'posts.id', '=', 'category_post.post_id')
        ->where('category_post.category_id','=', $category->id)
        ->where('active','=', true)
        ->whereDate('published_at', '<', Carbon::now())
        ->orderBy('published_at', 'desc')
        ->paginate(10);
        return view('post.index', compact('posts', 'category'));
    }

}
