@extends('frontend.layouts.main')

@push('title')
    {{ $product->name }}
@endpush

@section('description', $product->description)

@section('keywords', $product->keywords)

@push('meta')
    <meta property="og:title" content="{{ $product->name }}">
    <meta property="og:description" content="{{ $product->description }}">
    <meta property="og:image" content="{{ asset(Storage::url($product->avatar)) }}">
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
                        <h2>Chi tiết Gói Photobooth</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="project_details section_padding">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="single_project_item">
                    <img src="{{ Storage::url($product->avatar) }}" alt="">
                    <h2>{{ $product->name }}</h2>
                    <p>{{ $product->description }}</p>
                    <div class="project_time">
                        <div class="row">
                            <div class="col-lg-4 col-sm-4">
                                <div class="single_project_details text-center">
                                    <div class="media d-block">
                                        <i class="fas fa-tags fa-2x text-primary d-block mx-auto mb-2"></i>
                                        <div class="media-body">
                                            <h5 class="mt-0">Giá gốc</h5>
                                            @if($product->sale_price && $product->sale_price < $product->price)
                                                <h3>
                                                    <del class="text-muted">
                                                        {{ number_format($product->price, 0, ',', '.') }} VND
                                                    </del>
                                                </h3>
                                                @else
                                                <h3>{{ number_format($product->price, 0, ',', '.') }} VND</h3>
                                                @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-4">
                                <div class="single_project_details text-center">
                                    <div class="media d-block">
                                        <i class="fas fa-percent fa-2x text-danger d-block mx-auto mb-2"></i>
                                        <div class="media-body">
                                            <h5 class="mt-0">Giá khuyến mãi</h5>
                                            @if($product->sale_price && $product->sale_price < $product->price)
                                                <h3 class="text-danger">
                                                    {{ number_format($product->sale_price, 0, ',', '.') }} VND
                                                </h3>
                                                @else
                                                <h3>—</h3>
                                                @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-4">
                                <div class="single_project_details text-center">
                                    <div class="media d-block">
                                        <i class="fas fa-clock fa-2x text-success d-block mx-auto mb-2"></i>
                                        <div class="media-body">
                                            <h5 class="mt-0">Giờ thuê</h5>
                                            <h3 class="fw-bold">
                                                {{ $product->rent_time ?? 'Liên hệ' }}
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! $product->content !!}
                    <a href="https://zalo.me/0765079049" target="_blank" class="btn_2 mb-3 mt-3">Thuê ngay</a>
                </div>
            </div>
        </div>
    </div>
</section>
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
                                <del class="text-dark small">{{ number_format($product->price, 0, ',', '.') }} VND</del>
                            </h3>
                            @else
                            <h3>{{ number_format($product->price, 0, ',', '.') }} VND</h3>
                            @endif
                            <p>
                                {{ $product->description }}
                                {{-- {!! $product->content !!} --}}
                            </p>
                            <a href="{{ route('product.detail', $product) }}" class="btn_3 mb-3 mt-3">Chi tiết</a>
                            <a href="https://zalo.me/0765079049" target="_blank" class="btn_2 mb-3 mt-3">Thuê ngay</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection