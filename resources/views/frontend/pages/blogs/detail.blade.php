@extends('frontend.layouts.main')
@push('title')
    {{ $blog->title }}
@endpush

@section('description', $blog->description)

@section('keywords', $blog->keywords)

@push('meta')
    <meta property="og:title" content="{{ $blog->title }}">
    <meta property="og:description" content="{{ $blog->description }}">
    <meta property="og:image" content="{{ asset(Storage::url($blog->avatar)) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
@endpush

@section('content')
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner text-center">
                    <div class="breadcrumb_iner_item">
                        <h2>Chi tiết bài viết</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="blog_area single-post-area section_padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 posts-list">
                <div class="single-post">
                    <div class="feature-img">
                        <img class="img-fluid" src="{{ Storage::url($blog->avatar) }}" alt="">
                    </div>
                    <div class="blog_details">
                        <h2>{{ $blog->title }}
                        </h2>
                        <ul class="blog-info-link mt-3 mb-4">
                            <li><a href="#"><i class="far fa-user"></i>9XBOX Photobooth</a></li>
                        </ul>
                        {!! $blog->content !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    <aside class="single_sidebar_widget popular_post_widget">
                        <h3 class="widget_title">Bài viết mới nhất</h3>
                        @foreach($blogs as $blog_item)
                        <div class="media post_item">
                            <img src="{{ Storage::url($blog_item->avatar) }}" alt="post">
                            <div class="media-body">
                                <a href="{{ route('blog.detail', $blog_item) }}">
                                    <h3>{{ $blog_item->title }}</h3>
                                </a>
                                <p>{{ $blog_item->created_at->format('d/m/y') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </aside>
                    <aside class="single_sidebar_widget popular_post_widget">
                        <h3 class="widget_title">Gói Photobooth</h3>
                        @foreach($products as $product)
                        <div class="product-card mb-4 text-center">
                            <img src="{{ Storage::url($product->avatar) }}" alt="{{ $product->name }}"
                                class="img-fluid">

                            <div class="product_info mt-3">
                                <a href="{{ route('product.detail', $product) }}">
                                    <h3>{{ $product->name }}</h3>
                                </a>

                                @if($product->sale_price && $product->sale_price < $product->price)
                                    <h5>
                                        <span class="text-danger">
                                            {{ number_format($product->sale_price, 0, ',', '.') }} VND
                                        </span>
                                        <br>
                                        <del class="text-dark small">
                                            {{ number_format($product->price, 0, ',', '.') }} VND
                                        </del>
                                    </h5>
                                    @else
                                    <h5>{{ number_format($product->price, 0, ',', '.') }} VND</h5>
                                    @endif

                                    <p>
                                        {{ $product->description }}
                                    </p>
                                    <a href="{{ route('product.detail', $product) }}"
                                        class="btn_3 page_detail mb-3 mt-3">Chi tiết</a>
                                    <a href="https://zalo.me/0765079049" target="_blank"
                                        class="btn_2 page_detail mb-3 mt-3">Thuê ngay</a>
                            </div>
                        </div>
                        @endforeach
                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection