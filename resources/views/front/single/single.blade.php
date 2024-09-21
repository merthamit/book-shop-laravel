@extends('front.layouts.master')
@section('title', $book->title)
@section('content')
    <!-- ================ start banner area ================= -->
    <section class="blog-banner-area" id="blog">
        <div class="container h-100">
            <div class="blog-banner">
                <div class="text-center">
                    <h1>{{ $book->title }}</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Shop Single</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ end banner area ================= -->

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    @endif

    <!--================Single Product Area =================-->
    <div class="product_image_area">
        <div class="container">
            <div class="row s_product_inner">
                <div class="col-lg-6">
                    <div class="owl-carousel owl-theme s_Product_carousel">
                        <div class="single-prd-item">
                            <img class="img-fluid" src="{{ $book->image }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <form action="{{ route('shop.cart.add') }}" method="POST">
                        @csrf
                        <div class="s_product_text">
                            <h3>{{ $book->title }}</h3>
                            <input type="hidden" name="title" value="{{ $book->title }}">
                            <input type="hidden" name="item_id" value="{{ $book->id }}">
                            @auth
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            @endauth
                            <input type="hidden" name="image" value="{{ $book->image }}">

                            <h2>${{ $book->price }}</h2>
                            <input type="hidden" name="price" value="{{ $book->price }}">
                            <ul class="list">
                                <li><span>Kategori:</span><span
                                        class="badge badge-primary">{{ $book->getCategory->title }}</span>
                                </li>
                                <li class="d-flex align-items-center"><span>Stok:</span>@include('front.single.availibility')
                                </li>
                            </ul>
                            <p>{{ $book->brief }}</p>
                            <div class="product_count">
                                @if ($book->stock != 0)
                                    <label for="qty">Sayı:</label>
                                    <input type="number" name="quantity" id="sst" size="2"
                                        max="{{ $book->stock }}" min="1" value="1" title="Quantity:"
                                        class="input-text qty">

                                    <button class="button primary-btn" type="submit">Sepete Ekle</button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--================End Single Product Area =================-->

    <!--================Product Description Area =================-->
    <section class="product_description_area">
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                        aria-selected="true">Açıklama</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                        aria-controls="profile" aria-selected="false">Kitabın Özellikleri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="review-tab" data-toggle="tab" href="#review" role="tab"
                        aria-controls="review" aria-selected="false">Değerlendirmeler</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <p>{{ $book->content }}</p>
                </div>
                <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <h5>Yazar</h5>
                                    </td>
                                    <td>
                                        <h5>{{ $book->author }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Dil</h5>
                                    </td>
                                    <td>
                                        <h5>{{ $book->language }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Çıkış Yılı</h5>
                                    </td>
                                    <td>
                                        <h5>{{ $book->release_date }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Sayfa Sayısı</h5>
                                    </td>
                                    <td>
                                        <h5>{{ $book->page_count }}</h5>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade  " id="review" role="tabpanel" aria-labelledby="review-tab">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row total_rate">
                                <div class="col-12">
                                    <div class="box_total">
                                        <h5>Puan</h5>
                                        @if ($book->rating_count != 0)
                                            <h4>{{ number_format($book->rating / $book->rating_count, 2) }}</h4>
                                            <h6>({{ $book->rating_count }} İnceleme)</h6>
                                        @else
                                            <h4>0</h4>
                                            <h6>(0 İnceleme)</h6>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="review_list mt-4">
                                @foreach ($comments as $comment)
                                    <div class="review_item">
                                        <div class="media">
                                            <div class="media-body">
                                                <div class="d-flex justify-content-between">
                                                    <h4>{{ $comment->getUserName->name }}</h4>
                                                    @if ($comment->user_id == Auth::user()->id)
                                                        <a href="{{ route('single.comment.delete', $comment->id) }}"
                                                            class="btn btn-sm btn-danger">Sil</a>
                                                    @endif
                                                </div>
                                                @for ($i = 0; $i < $comment->rating; $i++)
                                                    <i class="fa fa-star"></i>
                                                @endfor
                                            </div>
                                        </div>
                                        <p>{{ $comment->comment }}</p>
                                    </div>
                                    <hr />
                                @endforeach
                            </div>
                        </div>
                        @if (Auth::check())
                            <div class="col-lg-6">
                                <form action="{{ route('single.comment', $book->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="0" name="rating" id="rating" />
                                    <div class="review_box">
                                        <h4>Bir inceleme ekle</h4>
                                        <p>Puanın</p>
                                        <ul class="list">
                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                        </ul>
                                        <div class="form-group">
                                            <textarea class="form-control different-control w-100" name="comment" id="textarea" cols="30" rows="5"
                                                placeholder="Enter Message"></textarea>
                                        </div>
                                        <div class="form-group text-center text-md-right mt-3">
                                            <button type="submit"
                                                class="button button--active button-review">Gönder</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div class="col-lg-6">
                                <div class="alert alert-warning">Değerlendirme yapabilmek için üye olunuz veya giriş
                                    yapınız.</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Product Description Area =================-->

@endsection
@section('css')
    <style>
        .fa-star {
            font-size: 24px;
            color: black;
            cursor: pointer;
        }

        .green {
            color: rgb(255, 230, 0);
        }

        .black {
            color: black;
        }
    </style>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.list .fa-star').click(function(event) {
                event.preventDefault();

                var index = $(this).closest('li').index(); // li elemanının indeksini alır
                var rating = $('#rating');
                rating.val(index + 1)
                $('.list .fa-star').each(function(i) {
                    if (i <= index) {
                        $(this).removeClass('black').addClass('green');
                    } else {
                        $(this).removeClass('green').addClass('black');
                    }
                });
            });
        });
    </script>
@endsection
