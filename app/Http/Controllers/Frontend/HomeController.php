<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backdrop;
use App\Models\Blog;
use App\Models\Frame;
use App\Models\FrameType;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 1)->take(3)->get();
        // Lấy frame theo loại, mỗi loại 8 frame
        $framesByType = Frame::where('status', 1)
            ->select('id', 'slug', 'name', 'description', 'avatar', 'frame_type_id')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('frame_type_id')
            ->map(function ($items) {
                return $items->take(9);
            });

        $frames = Frame::where('status', 1)
            ->select('id', 'slug', 'name', 'description', 'content', 'avatar', 'frame_type_id', 'is_hot')
            ->latest()
            ->get();
        $frameTypes = FrameType::where('status', 1)->get();
        $backdrops = Backdrop::where('status', 1)->get();
        $blogs = Blog::where('status', 1)->latest()->take(3)->get();

        return view('frontend.pages.home', compact('products', 'frameTypes', 'frames', 'backdrops', 'blogs'));
    }
}
