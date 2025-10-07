<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $products = Product::select('id', 'slug', 'name', 'description', 'content', 'avatar', 'price', 'sale_price')->where('status', 1)->latest()->get();

        $contact = Setting::allAsArray();

        $contact['map_content'] ?? '';

        return view('frontend.pages.contact', compact('contact', 'products'));
    }

    public function about()
    {
        $products = Product::select('id', 'slug', 'name', 'description', 'content', 'avatar', 'price', 'sale_price')->where('status', 1)->latest()->get();

        $aboutUs = Setting::allAsArray();
        $aboutUs['introduce_image'] ?? '';
        $aboutUs['introduce_description'] ?? '';
        $aboutUs['introduce_content'] ?? '';

        return view('frontend.pages.about_us', compact('aboutUs', 'products'));
    }
}
