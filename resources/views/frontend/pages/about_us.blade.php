@extends('frontend.layouts.main')

@section('content')
<!-- breadcrumb start-->
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner text-center">
                    <div class="breadcrumb_iner_item">
                        <h2>Về chúng tôi</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb start-->

<!--::about_us part start::-->
<section class="about_us section_padding">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-8">
                <div class="about_us_text text-center">
                    <h5>9XBOX Photobooth</h5>
                    <h2>{{ $aboutUs['introduce_description'] }}</h2>
                    <p>{!! $aboutUs['introduce_content'] !!}</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--::about_us part end::-->
<section class="pricing_part section_padding home_page_pricing">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section_tittle">
                    <h2>Gói Photobooth</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach($products as $product)
            <div class="col-lg-4 col-sm-6 px-0">
                <div class="single_pricing_part">
                    <div class="pricing_tittle">
                        <img src="{{ Storage::url($product->avatar) }}" alt="">
                        <a href="{{ route('product.detail', $product) }}">
                            <h3>{{ $product->name }}</h3>
                        </a>
                    </div>
                    <div class="pricing_content">
                        @if($product->sale_price && $product->sale_price < $product->price)
                            <h3>
                                <span class="text-danger">{{ number_format($product->sale_price, 0, ',', '.') }}
                                    VND</span>
                                <del class="text-dark small">{{ number_format($product->price, 0, ',', '.') }}
                                    VND</del>
                            </h3>
                            @else
                            <h3>{{ number_format($product->price, 0, ',', '.') }} VND</h3>
                            @endif
                            <p>
                                {{ $product->description }}
                            </p>
                            <a href="{{ route('product.detail', $product) }}" class="btn_3 mb-3 mt-3">Chi tiết</a>
                            <a href="https://zalo.me/0765079049" target="_blank" class="btn_2 mb-3 mt-3">Thuê
                                ngay</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection