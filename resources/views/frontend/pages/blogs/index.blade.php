@extends('frontend.layouts.main')

@section('content')
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner text-center">
                    <div class="breadcrumb_iner_item">
                        <h2>Tin tức</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="blog_area section_padding">
    <div class="container">
        <div class="row">
            <!-- Danh sách blog -->
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="blog_left_sidebar">
                    @foreach($blogs as $blog)
                    <article class="blog_item">
                        <div class="blog_item_img">
                            <img class="card-img rounded-0" src="{{ Storage::url($blog->avatar) }}"
                                alt="{{ $blog->title }}">
                            <a href="#" class="blog_item_date">
                                <h3>{{ $blog->created_at->format('d') }}</h3>
                                <p>{{ $blog->created_at->format('M') }}</p>
                            </a>
                        </div>

                        <div class="blog_details">
                            <a class="d-inline-block" href="{{ route('blog.detail', $blog) }}">
                                <h2>{{ $blog->title }}</h2>
                            </a>
                            <p>{{ Str::limit($blog->description, 150) }}</p>
                            <ul class="blog-info-link">
                                <li>
                                    <a href="#"><i class="far fa-user"></i> {{ $blog->author ?? 'Admin' }}</a>
                                </li>
                            </ul>
                        </div>
                    </article>
                    @endforeach

                    <!-- Pagination -->
                    <nav class="blog-pagination justify-content-center d-flex">
                        {{ $blogs->links('pagination::bootstrap-4') }}
                    </nav>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="blog_right_sidebar">
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
                                <a href="{{ route('product.detail', $product) }}" class="btn_3 page_detail mb-3 mt-3">Chi tiết</a>
                                <a href="https://zalo.me/0765079049" target="_blank" class="btn_2 page_detail mb-3 mt-3">Thuê ngay</a>
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