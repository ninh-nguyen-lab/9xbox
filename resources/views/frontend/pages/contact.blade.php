@extends('frontend.layouts.main')
@section('content')
<!-- breadcrumb start-->
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner text-center">
                    <div class="breadcrumb_iner_item">
                        <h2>contact</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb start-->

<!-- ================ contact section start ================= -->
<section class="contact-section section_padding">
    <div class="container">
        <div class="d-none d-sm-block mb-5 pb-4">
            <div id="map" style="height: 480px;">
                {!! $setting['map_content'] ?? '' !!}
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h2 class="contact-title">Fanpage</h2>
            </div>
            <div class="col-lg-8">
                <div class="fb-page" data-href="https://www.facebook.com/9xbox/" data-tabs="timeline" data-width="500"
                    data-height="600" data-small-header="false" data-adapt-container-width="true"
                    data-hide-cover="false" data-show-facepile="true">
                    <blockquote cite="https://www.facebook.com/9xbox/" class="fb-xfbml-parse-ignore">
                        <a href="https://www.facebook.com/9xbox/">9xbox</a>
                    </blockquote>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-home"></i></span>
                    <div class="media-body">
                        <h3>{{ $setting['company_address'] }}</h3>
                    </div>
                </div>
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                    <div class="media-body">
                        <h3>{{ $setting['company_phone'] }}</h3>
                        <p>Từ thứ 2 đến chủ nhật</p>
                    </div>
                </div>
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-email"></i></span>
                    <div class="media-body">
                        <h3>{{ $setting['company_email'] }}</h3>
                        <p>Gửi cho chúng tôi bất cứ thắc mắc nào!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ================ contact section end ================= -->
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
                            <a href="https://zalo.me/0765079049" target="_blank" class="btn_2 mb-3 mt-3">Thuê ngay</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection