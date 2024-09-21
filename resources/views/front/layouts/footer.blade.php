<!--================ Start footer Area  =================-->
<footer class="footer">
    <div class="footer-area">
        <div class="container">
            <div class="row section_gap">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-footer-widget tp_widgets">
                        <h4 class="footer_title large_title">Misyonumuz</h4>
                        <p>
                            {{ $footer->mission }}
                        </p>
                    </div>
                </div>
                <div class="offset-lg-1 col-lg-2 col-md-6 col-sm-6">
                    <div class="single-footer-widget tp_widgets">
                        <h4 class="footer_title">Sayfalar</h4>
                        @php
                            $menus = config('menu.items');
                        @endphp
                        <ul class="list">
                            @foreach ($menus as $menu)
                                <li><a href="{{ route($menu['link']) }}">{{ $menu['title'] }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="single-footer-widget instafeed">
                        <h4 class="footer_title">Bazı Kitaplar</h4>
                        <ul class="list instafeed d-flex flex-wrap">
                            <ul class="list instafeed d-flex flex-wrap">
                                <li><img src="{{ asset('front') }}/img/gallery/r1.jpg" alt=""></li>
                                <li><img src="{{ asset('front') }}/img/gallery/r2.jpg" alt=""></li>
                                <li><img src="{{ asset('front') }}/img/gallery/r3.jpg" alt=""></li>
                                <li><img src="{{ asset('front') }}/img/gallery/r5.jpg" alt=""></li>
                                <li><img src="{{ asset('front') }}/img/gallery/r7.jpg" alt=""></li>
                                <li><img src="{{ asset('front') }}/img/gallery/r8.jpg" alt=""></li>
                            </ul>
                        </ul>
                    </div>
                </div>
                <div class="offset-lg-1 col-lg-3 col-md-6 col-sm-6">
                    <div class="single-footer-widget tp_widgets">
                        <h4 class="footer_title">İletişim</h4>
                        <div class="ml-40">
                            <p class="sm-head">
                                <span class="fa fa-location-arrow"></span>
                                Ana Adres
                            </p>
                            <p>{{ $footer->address }}</p>

                            <p class="sm-head">
                                <span class="fa fa-phone"></span>
                                Telefon Numarası
                            </p>
                            <p>
                                {{ $footer->phone }} <br>

                            </p>

                            <p class="sm-head">
                                <span class="fa fa-envelope"></span>
                                Email
                            </p>
                            <p>
                                {{ $footer->email }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</footer>
<!--================ End footer Area  =================-->



<script src="{{ asset('/front') }}/vendors/jquery/jquery-3.2.1.min.js"></script>
<script src="{{ asset('/front') }}/vendors/bootstrap/bootstrap.bundle.min.js"></script>
<script src="{{ asset('/front') }}/vendors/skrollr.min.js"></script>
<script src="{{ asset('/front') }}/vendors/owl-carousel/owl.carousel.min.js"></script>
<script src="{{ asset('/front') }}/vendors/nice-select/jquery.nice-select.min.js"></script>
<script src="{{ asset('/front') }}/vendors/jquery.ajaxchimp.min.js"></script>
<script src="{{ asset('/front') }}/vendors/mail-script.js"></script>
<script src="{{ asset('/front') }}/js/main.js"></script>
@yield('js')
</body>

</html>
