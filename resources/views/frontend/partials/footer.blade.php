<footer class="footer-area">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-sm-6 col-md-6 col-lg-4">
                <div class="single-footer-widget">
                    <h4>Chúng tôi</h4>
                    <ul>
                        <li><a href="/">Trang chủ</a></li>
                        <li><a href="{{ route('about-us.about') }}">Về chúng tôi</a></li>
                        <li><a href="{{ route('frame.index') }}">Khung hình</a></li>
                        <li><a href="{{ route('blog.index') }}">Tin tức</a></li>
                        <li><a href="{{ route('contact.index') }}">Liên hệ</a></li>
                    </ul>

                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4">
                <div class="single-footer-widget footer_icon">
                    <h4>Liên hệ</h4>
                    <p>{{ $setting['company_address'] ?? '' }}</p>
                    <ul>
                        <li><a href="#"><i class="ti-mobile"></i>{{ $setting['company_phone'] ?? '' }}</a></li>
                        <li><a href="#"><i class="ti-email"></i>{{ $setting['company_email'] ?? '' }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4">
                <div class="single-footer-widget footer_3">
                    <h4>Fanpage</h4>
                    <div class="footer_img">
                        <div class="fb-page" data-href="https://www.facebook.com/9xbox" data-width="340"
                            data-hide-cover="false" data-show-facepile="true"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="copyright_part_text text-center">
                    <p class="footer-text m-0">
                        &copy;<script>
                            document.write(new Date().getFullYear());
                        </script> {{ $setting['company_title'] ?? '' }} All rights reserved | Designed by <a
                            href="https://tmsoftware.vn/" target="_blank">TM Branding</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>