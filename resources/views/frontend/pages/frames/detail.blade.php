@extends('frontend.layouts.main')

@push('title')
    {{ $frame->name }}
@endpush

@section('description', $frame->description)

@section('keywords', $frame->keywords)

@push('meta')
    <meta property="og:title" content="{{ $frame->name }}">
    <meta property="og:description" content="{{ $frame->description }}">
    <meta property="og:image" content="{{ asset(Storage::url($frame->avatar)) }}">
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
                        <h2>Chi tiết khung hình</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="frame_detail section_padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <h2>{{ $frame->name }}</h2>
                <p><strong>Loại:</strong> {{ $frame->frameType->name ?? 'Không xác định' }}</p>
                <p>{!! $frame->content !!}</p>

                <img id="main-avatar" src="{{ Storage::url($frame->avatar) }}" class="img-fluid mb-4"
                    alt="{{ $frame->name }}">
            </div>
        </div>

        <div class="frame-album row g-3 popup-gallery">
            @foreach($frame->album ?? [] as $image)
            <div class="col-md-3 col-4">
                <a href="{{ Storage::url($image) }}" title="{{ $frame->name }}">
                    <img src="{{ Storage::url($image) }}" class="img-fluid rounded" style="cursor:pointer"
                        alt="album image">
                </a>
            </div>
            @endforeach
        </div>
    </div>

    @if($relatedFrames->count())
    <section class="gallery_part section_padding">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7 offset-lg-2">
                    <div class="section_tittle">
                        <h2>Khung hình liên quan</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="gallery_part_item filtr-container">
                        @foreach($relatedFrames as $related)
                        <div class="img-gal filtr-item" data-category="{{ $related->frame_type_id }}"
                            style="background-image: url({{ Storage::url($related->avatar) }})">
                            <div class="single_gallery_item">
                                <div class="single_gallery_item_iner">
                                    <div class="gallery_item_text">
                                        <h3 class="frame-name">
                                            <a href="{{ route('frame.detail', $related) }}">
                                                {{ $related->name }}
                                            </a>
                                        </h3>
                                        <h4 class="content-frame">{!! $frame->content !!}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

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
                                <a href="{{ route('product.detail', $product) }}"
                                    class="btn_3 page_detail mb-3 mt-3">Chi tiết</a>
                                <a href="https://zalo.me/0765079049" target="_blank"
                                    class="btn_2 page_detail mb-3 mt-3">Thuê ngay</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</section>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
    $('.popup-gallery').magnificPopup({
        delegate: 'a',
        type: 'image',
        gallery: {
            enabled: true
        }
    });
});
</script>
@endsection