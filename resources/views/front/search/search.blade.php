@extends('front.layouts.master')
@section('title', 'Kitap Bul')
@section('content')
    <!-- ================ start banner area ================= -->
    <section class="blog-banner-area" id="category">
        <div class="container h-100">
            <div class="blog-banner">
                <div class="text-center">
                    <h1>@yield('title')</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ end banner area ================= -->


    <!-- ================ category section start ================= -->
    <section class="section-margin--small mb-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-5">
                    <form action="{{ route('search') }}" method="GET">
                        <div class="sidebar-categories">
                            <div class="head">Kategoriler</div>
                            <ul class="main-categories">
                                <li class="common-filter">
                                    <ul style="height:200px; overflow:scroll; overflow-x:hidden">
                                        <li class="filter-list"><input class="pixel-radio" type="radio" id="hepsi"
                                                name="category" @if ($oldInput['category'] == 'hepsi') checked @endif
                                                value="hepsi" /><label for="category"> Hepsi<span>
                                                </span></label></li>
                                        @foreach ($categories as $category)
                                            <li class="filter-list"><input class="pixel-radio" type="radio"
                                                    id="{{ $category->slug }}" name="category"
                                                    @if ($oldInput['category'] == $category->slug) checked @endif
                                                    value="{{ $category->slug }}" /><label
                                                    for="category">{{ $category->title }}<span>
                                                        ({{ $category->categoryCount() }})
                                                    </span></label></li>
                                        @endforeach

                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="sidebar-filter">
                            <div class="top-filter-head">Kitap</div>
                            <div class="common-filter">
                                <div class="head">Sayfa Sayısı</div>
                                <ul>
                                    <li class="filter-list"><input class="pixel-radio" type="radio" value="0-99999"
                                            @if ($oldInput['pages'] == '0-99999') checked @endif name="pages"><label
                                            for="apple">Hepsi<span></span></label></li>
                                    <li class="filter-list"><input class="pixel-radio" type="radio" value="0-50"
                                            @if ($oldInput['pages'] == '0-50') checked @endif name="pages"><label
                                            for="apple">0-50<span></span></label></li>
                                    <li class="filter-list"><input class="pixel-radio" type="radio" value="50-100"
                                            @if ($oldInput['pages'] == '50-100') checked @endif name="pages"><label
                                            for="asus">50-100<span></span></label></li>
                                    <li class="filter-list"><input class="pixel-radio" type="radio" value="100-150"
                                            @if ($oldInput['pages'] == '100-150') checked @endif name="pages"><label
                                            for="gionee">100-150<span></span></label></li>
                                    <li class="filter-list"><input class="pixel-radio" type="radio" value="150-200"
                                            @if ($oldInput['pages'] == '150-200') checked @endif name="pages"><label
                                            for="micromax">150-200<span></span></label>
                                    </li>
                                    <li class="filter-list"><input class="pixel-radio" type="radio" value="200-250"
                                            @if ($oldInput['pages'] == '200-250') checked @endif name="pages"><label
                                            for="samsung">200-250<span></span></label>
                                    </li>
                                    <li class="filter-list"><input class="pixel-radio" type="radio" value="250-300"
                                            @if ($oldInput['pages'] == '250-300') checked @endif name="pages"><label
                                            for="samsung">250-300<span>(19)</span></label>
                                    </li>
                                </ul>
                            </div>
                            <div class="common-filter">
                                <div class="head">Price</div>
                                <div class="price-range-area">
                                    <div id="price-range"></div>
                                    <div class="value-wrapper d-flex">
                                        <div class="price">Price:</div>
                                        <span>$</span>
                                        <div id="lower-value"></div>
                                        <div class="to">to</div>
                                        <span>$</span>
                                        <div id="upper-value"></div>
                                    </div>
                                </div>
                                <input type="hidden" id="min-value" name="min">
                                <input type="hidden" id="max-value" name="max">
                            </div>
                            <button class="button mt-3 w-100">Ara</button>

                        </div>
                    </form>
                </div>
                <div class="col-xl-9 col-lg-8 col-md-7">
                    <!-- Start Filter Bar -->
                    <div class="filter-bar d-flex flex-wrap align-items-center">
                        <div class="sorting">
                            <select>
                                <option value="1">Default sorting</option>
                                <option value="1">Default sorting</option>
                                <option value="1">Default sorting</option>
                            </select>
                        </div>
                        <div class="sorting mr-auto">
                            <select>
                                <option value="1">Show 12</option>
                                <option value="1">Show 12</option>
                                <option value="1">Show 12</option>
                            </select>
                        </div>
                    </div>
                    <!-- End Filter Bar -->
                    <!-- Start Best Seller -->
                    <section class="lattest-product-area pb-40 category-list">
                        <div class="row">
                            @foreach ($books as $book)
                                <div class="col-md-6 col-lg-4">
                                    <div class="card text-center card-product">
                                        <div class="card-product__img">
                                            <img class="card-img" src="{{ $book->image }}" alt="">
                                            <ul class="card-product__imgOverlay">
                                                <li><button><i class="ti-search"></i></button></li>
                                                <li><button><i class="ti-shopping-cart"></i></button></li>
                                                <li><button><i class="ti-heart"></i></button></li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <p>{{ $book->getCategory->title }}</p>
                                            <h4 class="card-product__title"><a
                                                    href="{{ route('single', $book->id) }}">{{ $book->title }}</a></h4>
                                            <p class="card-product__price">${{ $book->price }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{ $books->links() }}
                    </section>
                    <!-- End Best Seller -->
                </div>
            </div>
        </div>
    </section>
    <!-- ================ category section end ================= -->

@endsection
@section('js')
    <script src="{{ asset('/front') }}/vendors/nouislider/nouislider.min.js"></script>
    <script>
        if (document.getElementById("price-range")) {
            var nonLinearSlider = document.getElementById("price-range");

            noUiSlider.create(nonLinearSlider, {
                connect: true,
                behaviour: "tap",
                start: [0, 200],
                range: {
                    // Starting at 500, step the value by 500,
                    // until 4000 is reached. From there, step by 1000.
                    min: [0],
                    "10%": [10, 10],
                    "50%": [80, 20],
                    max: [200],
                },
            });
            var nodes = [
                document.getElementById("lower-value"), // 0
                document.getElementById("upper-value"), // 1
            ];

            var minValueInput = document.getElementById("min-value");
            var maxValueInput = document.getElementById("max-value");
            // Display the slider value and how far the handle moved
            // from the left edge of the slider.
            nonLinearSlider.noUiSlider.on(
                "update",
                function(values, handle, unencoded, isTap, positions) {
                    nodes[handle].innerHTML = values[handle];
                    console.log(values)
                    if (handle === 0) {
                        minValueInput.value = values[0];
                    } else {
                        maxValueInput.value = values[1];
                    }
                }
            );
        }
    </script>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('/front') }}/vendors/nouislider/nouislider.min.css">
@endsection
