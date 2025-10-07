<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frame;
use App\Models\FrameType;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $frameTypes = FrameType::where('status', 1)->get();
        $frames = Frame::where('status', 1)
            ->select('id', 'slug', 'name', 'description', 'avatar', 'frame_type_id', 'is_hot')
            ->latest()
            ->get();
            
        $products = Product::select('id', 'slug', 'name', 'description', 'avatar', 'price', 'sale_price')->where('status', 1)->get();
        return view('frontend.pages.products.index', compact('products', 'frames', 'frameTypes'));
    }
    
    public function detail(Product $product)
    {
        $products = Product::select('id', 'slug', 'name', 'description', 'content', 'avatar', 'price', 'sale_price', 'rent_time')
            ->where('status', 1)
            ->where('id', '!=', $product->id)
            ->get();

        return view('frontend.pages.products.detail', compact('product', 'products'));
    }
}
