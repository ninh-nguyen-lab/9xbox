@extends('frontend.layouts.main')

@section('content')
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner text-center">
                    <div class="breadcrumb_iner_item">
                        <h2>Gói Photobooth</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pricing_part section_padding home_page_pricing">
    <div class="container">
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
<section class="gallery_part section_padding">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5 offset-lg-2">
                <div class="section_tittle">
                    <h2>Mẫu khung hình</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="portfolio-filter filters">
                    <ul>
                        <li class="active" data-filter="0">Mẫu Phổ biến</li>
                        @foreach($frameTypes as $type)
                        <li data-filter="{{ $type->id }}">{{ $type->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="gallery_part_item filtr-container">
                    @foreach($frames as $frame)
                    <div class="img-gal filtr-item"
                        data-category="{{ $frame->frame_type_id }}{{ $frame->is_hot ? ',0' : '' }}"
                        style="background-image: url({{ Storage::url($frame->avatar) }})">
                        <div class="single_gallery_item">
                            <div class="single_gallery_item_iner">
                                <div class="gallery_item_text">
                                    <p>
                                        <a href="{{ route('frame.detail', $frame) }}">
                                            {{ $frame->name }}
                                        </a>
                                    </p>
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
@endsection
@section('scripts')
<script>
    $(function () {
    // Khởi tạo Filterizr v1
    var filterizd = $('.filtr-container').filterizr({
        // tuỳ chọn nếu cần, ví dụ:
        // animationDuration: 0.4,
        // gutterPixels: 0
    });

    // Ép filter mặc định về Hot (0)
    filterizd.filterizr('filter', '0');

    // Set lại nút active cho Hot
    $('.filters [data-filter]').removeClass('active');
    $('.filters [data-filter="0"]').addClass('active');

    // (Tùy chọn) gắn click thủ công nếu bạn không dùng control plugin
    $('.filters [data-filter]').on('click', function () {
        var f = $(this).data('filter');
        filterizd.filterizr('filter', f);
        $(this).addClass('active').siblings().removeClass('active');
    });
});
</script>
@endsection