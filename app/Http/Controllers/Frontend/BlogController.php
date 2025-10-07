<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Product;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::select('id', 'slug', 'title', 'description', 'avatar', 'created_at')->where('status', 1)->latest()->paginate(5);
        $products = Product::select('id', 'slug', 'name', 'description', 'avatar', 'price', 'sale_price')->where('status', 1)->get();
        return view('frontend.pages.blogs.index', compact('blogs', 'products'));
    }
    
    public function detail(Blog $blog)
    {
        $blogs = Blog::select('id', 'slug', 'title', 'description', 'avatar', 'created_at')
            ->where('status', 1)
            ->where('id', '!=', $blog->id)
            ->latest()
            ->take(4)
            ->get();

        $products = Product::select('id', 'slug', 'name', 'description', 'avatar', 'price', 'sale_price')->where('status', 1)->get();

        return view('frontend.pages.blogs.detail', compact('blog', 'blogs', 'products'));
    }
}