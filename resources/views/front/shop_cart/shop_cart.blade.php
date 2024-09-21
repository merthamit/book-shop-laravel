@extends('front.layouts.master')
@section('title', 'Alışveriş Sepeti')
@section('content')
    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Kitap</th>
                                <th scope="col">Fiyat</th>
                                <th scope="col">Sayı</th>
                                <th scope="col">Toplam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($items)
                                @foreach ($items as $item)
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <div class="d-flex">
                                                    <img src="{{ $item->image }}" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <p>{{ $item->title }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h5 class="price">{{ $item->price }}</h5>
                                        </td>
                                        <td>
                                            <div class="product_count">
                                                <input type="number" name="qty" id="{{ $item->title }}" maxlength="12"
                                                    title="Quantity:" class="quantity input-text qty"
                                                    value="{{ $item->quantity }}">
                                                <a href="{{ route('shop.cart.delete', $item->item_id) }}"
                                                    class="btn btn-danger">Sil</a>
                                            </div>
                                        </td>
                                        <td>
                                            <h5 class="quantityCount">${{ $item->quantity * $item->price }}</h5>
                                        </td>
                                    </tr>
                                @endforeach
                            @endisset

                            <tr class="bottom_button">
                                <td>
                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                                    <div class="cupon_text d-flex align-items-end justify-content-end">
                                        <input type="text" placeholder="Kupon Kodu">
                                        <a class="primary-btn" href="#">Onayla</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                                    <h5>Toplam</h5>
                                </td>
                                <td>
                                    <h5 class="total">$2160.00</h5>
                                </td>
                            </tr>
                            <tr class="shipping_area">
                                <td class="d-none d-md-block">

                                </td>
                                <td>

                                </td>
                                <td>
                                    <h5>Kargo</h5>
                                </td>
                                <td>
                                    <div class="shipping_box">
                                        <ul class="list">
                                            <li class="active"><a href="#">Kargo bedeli: $50.00</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr class="out_button_area">
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                                    <div class="checkout_btn_inner d-flex align-items-center">
                                        <a class="gray_btn" href="#">Alışverişe devam et</a>
                                        <a class="primary-btn ml-2" href="{{ route('checkout.stepone') }}">Öde</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('front') }}/vendors/linericon/style.css">
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            let total = $(".total")
            let price = $(".price")
            let quantity = $(".quantity")
            let quantityCountAll = $(".quantityCount")
            let totalCount = 0
            quantityCountAll.each((q, qua) => {
                let pr = parseFloat($(qua).text().replace(/[^0-9.]/g, ''))
                totalCount += pr
            })
            total.text(totalCount.toFixed(2))

            quantity.each((i, item) => {
                $(item).on('input', function() { // veya 'click', 'keyup' vs.
                    let priceVal = parseFloat($(item).parent().parent().prev().children('.price')
                        .text())
                    let quantityCount = $(item).parent().parent().next().children('.quantityCount')

                    let count = $(item).val()

                    let calculcate = priceVal * count
                    quantityCount.text(calculcate.toFixed(2))
                    let totalCount = 0
                    quantityCountAll.each((q, qua) => {
                        let pr = parseFloat($(qua).text().replace(/[^0-9.]/g, ''))
                        totalCount += pr
                    })
                    total.text(totalCount.toFixed(2))

                });
            })

        })
    </script>
@endsection('js')
