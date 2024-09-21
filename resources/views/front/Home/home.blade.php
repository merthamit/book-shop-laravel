@extends('front.layouts.master')
@section('title', 'Anasayfa')
@section('content')

    <main class="site-main">

        <!--================ Hero banner start =================-->
        <section class="hero-banner">
            <div class="container">
                <div class="row no-gutters align-items-center pt-60px">
                    <div class="col-5 d-none d-sm-block">
                        <div class="hero-banner__img">
                            <img class="img-fluid" src="{{ asset('/front') }}/img/home/hero-banner.png" alt="">
                        </div>
                    </div>
                    <div class="col-sm-7 col-lg-6 offset-lg-1 pl-4 pl-md-5 pl-lg-0">
                        <div class="hero-banner__content">
                            <h4>{{ $hero->header_medium }}</h4>
                            <h1>{{ $hero->header_big }}</h1>
                            <p>{{ $hero->header_small }}</p>
                            <a class="button button-hero" href="#">{{ $hero->button_name }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================ Hero banner start =================-->

        <!--================ Hero Carousel start =================-->
        <section class="section-margin mt-0">
            <div class="owl-carousel owl-theme hero-carousel">
                @foreach ($books as $book)
                    <div class="hero-carousel__slide">
                        <img src="{{ $book->image }}" alt="" class="img-fluid">
                        <a href="{{ route('single', $book->id) }}" class="hero-carousel__slideOverlay">
                            <h3>{{ $book->title }}</h3>
                            <p>{{ $book->getCategory->title }}</p>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
        <!--================ Hero Carousel end =================-->

        <!-- ================ trending product section start ================= -->
        <section class="section-margin calc-60px">
            <div class="container">
                <div class="section-intro pb-60px">
                    <p>Popülaritesi artan kitaplar</p>
                    <h2>En çok bakılan <span class="section-intro__style">Kitaplar</span></h2>
                </div>
                <div class="row">
                    @foreach ($books as $book)
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="card text-center card-product">
                                <div class="card-product__img">
                                    <img class="card-img" src="{{ $book->image }}" alt="">
                                    <ul class="card-product__imgOverlay">
                                        <li><a href="{{ route('single', $book->id) }}"><i class="ti-shopping-cart"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <p>{{ $book->getCategory->title }}</p>
                                    <h4 class="card-product__title">
                                        <a href="{{ route('single', $book->id) }}">{{ $book->title }}</a>
                                    </h4>
                                    <p class="card-product__price">${{ $book->price }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- ================ trending product section end ================= -->


        <!-- ================ offer section start ================= -->
        <section class="offer" id="parallax-1" data-anchor-target="#parallax-1"
            data-300-top="background-position: 20px 30px" data-top-bottom="background-position: 0 20px">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5">
                        <div class="offer__content text-center">
                            <h3>{{ $parallax->header_big }}</h3>
                            <h4>{{ $parallax->header_medium }}</h4>
                            <p>{{ $parallax->header_small }}</p>
                            <a class="button button--active mt-3 mt-xl-4" href="#">{{ $parallax->button_name }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ================ offer section end ================= -->

        <!-- ================ Best Selling item  carousel ================= -->
        <section class="section-margin calc-60px">
            <div class="container">
                <div class="section-intro pb-60px">
                    <p>En çok satılan kitaplar</p>
                    <h2>En çok satılan <span class="section-intro__style">Kitaplar</span></h2>
                </div>
                <div class="owl-carousel owl-theme" id="bestSellerCarousel">
                    @foreach ($booksRating as $book)
                        <div class="card text-center card-product">
                            <div class="card-product__img">
                                <img class="img-fluid" src="{{ $book->image }}" alt="">
                                <ul class="card-product__imgOverlay">
                                    <li><a href="{{ route('single', $book->id) }}"><i class="ti-shopping-cart"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <p>{{ $book->getCategory->title }}</p>
                                <h4 class="card-product__title"><a
                                        href="{{ route('single', $book->id) }}">{{ $book->title }}</a></h4>
                                <p class="card-product__price">${{ $book->price }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- ================ Best Selling item  carousel end ================= -->


        <!-- ================ Subscribe section start ================= -->
        <section class="subscribe-position">
            <div class="container">
                <div class="subscribe text-center">
                    <h3 class="subscribe__title">Abone Ol</h3>
                    <p>Daha çok fırsat için bize abone olun.</p>
                    <div id="mc_embed_signup">
                        <form target="_blank"
                            action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                            method="get" class="subscribe-form form-inline mt-5 pt-1">
                            <div class="form-group ml-sm-auto">
                                <input class="form-control mb-1" type="email" name="EMAIL"
                                    placeholder="Email adresinizi girin." onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Your Email Address '">
                                <div class="info"></div>
                            </div>
                            <button class="button button-subscribe mr-auto mb-1" type="submit">Şimdi abone ol</button>
                            <div style="position: absolute; left: -5000px;">
                                <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value=""
                                    type="text">
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </section>
        <!-- ================ Subscribe section end ================= -->



    </main>

@endsection
