<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frame;
use App\Models\FrameType;
use App\Models\Product;
use Illuminate\Http\Request;

class FrameController extends Controller
{
    public function index()
    {
        $products = Product::select('id', 'slug', 'name', 'description', 'avatar', 'price', 'sale_price')
            ->where('status', 1)->get();

        $frameTypes = FrameType::where('status', 1)->get();

        // Lấy tất cả frame 1 lần
        $frames = Frame::where('status', 1)
            ->select('id', 'slug', 'name', 'description', 'content', 'avatar', 'frame_type_id', 'is_hot')
            ->latest()
            ->get();

        return view('frontend.pages.frames.index', compact('frameTypes', 'frames', 'products'));
    }


    public function detail(Frame $frame)
    {
        $products = Product::select('id', 'slug', 'name', 'description', 'content', 'avatar', 'price', 'sale_price')->where('status', 1)->get();

        $relatedFrames = Frame::where('frame_type_id', $frame->frame_type_id)->where('status', 1)
            ->where('id', '!=', $frame->id)
            ->latest()
            ->take(6)
            ->get();

        return view('frontend.pages.frames.detail', compact('frame', 'relatedFrames', 'products'));
    }
}
