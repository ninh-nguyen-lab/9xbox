@extends('frontend.layouts.main')

@push('title')
    {{ $setting['company_title'] }} - Photobooth
@endpush

@section('description', $setting['company_description'])
@section('keywords', $setting['company_keywords'])

@section('content')
<!--::banner part start::-->
<section class="banner_part">
    <div class="container">
        <div class="row align-items-center justify-content-end">
            <div class="col-lg-5">
                <div class="banner_text text-center">
                    <div class="banner_text_iner">
                        {{-- <h5>Model Photography</h5>
                        <h1>Creative <span>Studio</span></h1>
                        <p>Capturing moments from today</p>
                        <a href="#" class="btn_1">view work</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--::banner part start::-->

<!--::about_us part start::-->
<section class="about_us padding_top">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-8">
                <div class="about_us_text text-center">
                    <h5>Về chúng tôi</h5>
                    <h3>{{ $setting['introduce_description'] }}</h3>
                    <p>Câu chuyện của tôi bắt đầu từ thế giới của những lập trình viên – nơi những dòng code khô khan
                        được viết nên để tạo ra những sản phẩm số. Là một developer đam mê sáng tạo, tôi đã dành nhiều
                        năm làm việc với các thuật toán, giao diện người dùng và những dự án công nghệ đầy thử thách.
                        Nhưng sâu thẳm trong lòng, tôi luôn khao khát tạo ra điều gì đó gần gũi hơn, mang lại niềm vui
                        trực tiếp cho mọi người, không chỉ qua màn hình máy tính.</p>
                    <h3>Bước ngoặt với photobooth</h3>
                    <p>Một ngày, trong một sự kiện gia đình, tôi nhận ra sức mạnh của những bức ảnh in tức thì – cách
                        chúng khiến mọi người cười, kết nối và lưu giữ những khoảnh khắc đáng quý. Ý tưởng về photobooth
                        lóe lên như một tia sáng. Tại sao không mang niềm vui này đến với nhiều người hơn? Từ đó, tôi
                        quyết định bước ra khỏi vùng an toàn của mình, tạm gác lại bàn phím và mã code, để bắt đầu hành
                        trình khởi nghiệp với photobooth.</p>
                    <a href="{{ route('about-us.about') }}" class="btn_2">Đọc thêm</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--::about_us part end::-->

<!--::Product part start::-->
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
<!--::Product part end::-->

<!-- Frame part start-->
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

<!-- Frame part end-->

<!--::Backdrop part start::-->
<section class="our_service padding_bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section_tittle">
                    <h2>Phông nền</h2>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($backdrops as $index => $backdrop)
            <div class="col-lg-6 mb-4 d-flex">
                <!-- Card bao ngoài -->
                <div class="row d-flex align-items-stretch flex-fill border rounded shadow-sm overflow-hidden p-2">
                    @if($index % 2 == 0)
                    <!-- Text trái - Ảnh phải -->
                    <div class="col-4 d-flex">
                        <div class="single_offer_text text-center p-3 bg-light flex-fill border rounded">
                            <span class="flaticon-love-and-romance"></span>
                            <h4>{{ $backdrop->title }}</h4>
                            <p>{{ $backdrop->description }}</p>
                            {{-- <a href="#" class="btn_1">read more</a> --}}
                        </div>
                    </div>
                    <div class="col-8 d-flex">
                        <div class="single_offer_img flex-fill border rounded">
                            <img src="{{ Storage::url($backdrop->avatar) }}" alt=""
                                class="w-100 h-100 object-fit-cover rounded">
                        </div>
                    </div>
                    @else
                    <!-- Ảnh trái - Text phải -->
                    <div class="col-8 d-flex">
                        <div class="single_offer_img flex-fill border rounded">
                            <img src="{{ Storage::url($backdrop->avatar) }}" alt=""
                                class="w-100 h-100 object-fit-cover rounded">
                        </div>
                    </div>
                    <div class="col-4 d-flex">
                        <div class="single_offer_text text-center p-3 bg-light flex-fill border rounded">
                            <span class="flaticon-leaf"></span>
                            <h4>{{ $backdrop->title }}</h4>
                            <p>{{ $backdrop->description }}</p>
                            {{-- <a href="#" class="btn_1">read more</a> --}}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!--::Backdrop part end::-->

<!--::Blog part start::-->
<section class="catagory_post padding_bottom">
    <div class="container">
        <div class="row">
            <div class="col-xl-4">
                <div class="section_tittle">
                    <h2>Tin tức</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($blogs as $blog)
            <div class="col-sm-6 col-lg-4">
                <div class="single_catagory_post post_2">
                    <div class="category_post_img">
                        <img src="{{ Storage::url($blog->avatar) }}" alt="">
                    </div>
                    <div class="post_text_1 pr_30">
                        <h5>{{ $blog->created_at->format('d/m/Y') }}</h5>
                        <a href="{{ route('blog.detail', $blog) }}">
                            <h3>{{ $blog->title }}</h3>
                        </a>
                        <p>{{ $blog->description }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!--::Blog part end::-->
@endsection

@section('scripts')
<script>
    $(window).on('load', function () {
        var filterizd = $('.filtr-container').filterizr();

        // Ép filter mặc định về Hot (0)
        filterizd.filterizr('filter', '0');

        // Set lại nút active cho Hot
        $('.filters [data-filter]').removeClass('active');
        $('.filters [data-filter="0"]').addClass('active');

        // Gắn click cho filter menu
        $('.filters [data-filter]').on('click', function () {
            var f = $(this).data('filter');
            filterizd.filterizr('filter', f);
            $(this).addClass('active').siblings().removeClass('active');
        });
    });
</script>
@endsection
