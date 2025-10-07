<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Backdrop;
use App\Models\Blog;
use App\Models\Frame;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function show_dashboard()
    {
        $countProducts  = Product::where('status', 1)->count();
        $countFrames    = Frame::where('status', 1)->count();
        $countBackdrops = Backdrop::where('status', 1)->count();
        $countBlogs     = Blog::where('status', 1)->count();
        
        return view('admin.dashboard.index', compact('countProducts', 'countFrames', 'countBackdrops', 'countBlogs'));
    }

    public function dashboard(Request $request)
    {
        $admin_email = $request->admin_email;
        $admin_password = $request->admin_password;

        $admin = DB::table('administrators')
            ->where('email', $admin_email)
            ->first();

        if ($admin && Hash::check($admin_password, $admin->password)) {
            Session::put('admin_name', $admin->name);
            Session::put('admin_id', $admin->id);
            Session::put('admin_email', $admin_email);

            return Redirect::to('/dashboard');
        } else {
            return Redirect::to('/admin')->with('message', 'Mật khẩu hoặc tài khoản không đúng');
        }
    }

    public function logout()
    {
        Session::forget(['admin_name', 'admin_id', 'admin_email']);
        return Redirect::to('/admin')->with('message', 'Đã đăng xuất');
    }
}
