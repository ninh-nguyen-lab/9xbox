<?php

use App\Http\Controllers\Admin\BackdropController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FrameController;
use App\Http\Controllers\Admin\FrameTypeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Frontend\BlogController as FrontendBlogController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\FrameController as FrontendFrameController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Models\Blog;
use App\Models\Frame;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/frames', [FrontendFrameController::class, 'index'])->name('frame.index');
Route::get('/frame/{frame}', [FrontendFrameController::class, 'detail'])->name('frame.detail');
Route::get('/frames/load-more', [FrontendFrameController::class, 'loadMore'])->name('frames.loadMore');
Route::get('/products', [FrontendProductController::class, 'index'])->name('product.index');
Route::get('/product/{product}', [FrontendProductController::class, 'detail'])->name('product.detail');
Route::get('/blogs', [FrontendBlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{blog}', [FrontendBlogController::class, 'detail'])->name('blog.detail');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::get('/about-us', [ContactController::class, 'about'])->name('about-us.about');
// Back end
Route::get('/admin', [DashboardController::class, 'index']);
Route::post('/admin-dashboard', [DashboardController::class, 'dashboard']);
Route::get('/logout', [DashboardController::class, 'logout']);

// Các route cần đăng nhập admin
Route::middleware(['auth.admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'show_dashboard'])->name('dashboard');

    Route::prefix('admin/products')->name('products.')->group(function () {
        Route::get('/data', [ProductController::class, 'getData'])->name('data');
        Route::get('/{product}/json', [ProductController::class, 'getJson'])->name('json');
        Route::patch('/{product}/active', [ProductController::class, 'active'])->name('active');
        Route::patch('/{product}/unactive', [ProductController::class, 'unactive'])->name('unactive');
        Route::resource('/', ProductController::class)->parameters(['' => 'product']);
    });

    Route::prefix('admin/frames')->name('frames.')->group(function () {
        Route::get('/data', [FrameController::class, 'getData'])->name('data');
        Route::get('/{frame}/json', [FrameController::class, 'getJson'])->name('json');
        Route::patch('/{frame}/active', [FrameController::class, 'active'])->name('active');
        Route::patch('/{frame}/unactive', [FrameController::class, 'unactive'])->name('unactive');
        Route::resource('', FrameController::class)->parameters(['' => 'frame']);
    });


    Route::prefix('frame-types')->name('frame-types.')->group(function () {
        Route::get('/data', [FrameTypeController::class, 'getData'])->name('data');
        Route::get('/{frame_type}/json', [FrameTypeController::class, 'getJson'])->name('json');
        Route::patch('/{frame_type}/active', [FrameTypeController::class, 'active'])->name('active');
        Route::patch('/{frame_type}/unactive', [FrameTypeController::class, 'unactive'])->name('unactive');
        Route::resource('/', FrameTypeController::class)->parameters(['' => 'frame-type']);
    });

    Route::prefix('admin/backdrops')->name('backdrops.')->group(function () {
        Route::get('/data', [BackdropController::class, 'getData'])->name('data');
        Route::get('/{backdrop}/json', [BackdropController::class, 'getJson'])->name('json');
        Route::patch('/{backdrop}/active', [BackdropController::class, 'active'])->name('active');
        Route::patch('/{backdrop}/unactive', [BackdropController::class, 'unactive'])->name('unactive');
        Route::resource('/', BackdropController::class)->parameters(['' => 'backdrop']);
    });

    Route::prefix('admin/blogs')->name('blogs.')->group(function () {
        Route::get('/data', [BlogController::class, 'getData'])->name('data');
        Route::get('/{blog}/json', [BlogController::class, 'getJson'])->name('json');
        Route::patch('/{blog}/active', [BlogController::class, 'active'])->name('active');
        Route::patch('/{blog}/unactive', [BlogController::class, 'unactive'])->name('unactive');
        Route::resource('/', BlogController::class)->parameters(['' => 'blog']);
    });

    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('index');
        Route::post('/', [SettingController::class, 'update'])->name('update');
    });
});

Route::get('/sitemap.xml', function () {
    $sitemap = Sitemap::create();

    // Trang chủ
    $sitemap->add(
        Url::create('/')
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(1.0)
    );

    // Trang tĩnh (ví dụ: giới thiệu, liên hệ)
    $sitemap->add(
        Url::create('/about-us')
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            ->setPriority(0.7)
    );

    $sitemap->add(
        Url::create('/contact')
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            ->setPriority(0.7)
    );

    // Lấy link bài viết từ DB
    $products = Product::all();
    foreach ($products as $product) {
        $sitemap->add(
            Url::create("/product/{$product->slug}")
                ->setLastModificationDate($product->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.8)
        );
    }

    // Lấy link bài viết từ DB
    $blogs = Blog::all();
    foreach ($blogs as $blog) {
        $sitemap->add(
            Url::create("/blog/{$blog->slug}")
                ->setLastModificationDate($blog->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.8)
        );
    }

    // Lấy tất cả frames từ DB
    $frames = Frame::all();
    foreach ($frames as $frame) {
        $sitemap->add(
            Url::create("/frame/{$frame->slug}")
                ->setLastModificationDate($frame->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.8)
        );
    }
    
    return $sitemap->toResponse(request());
});

