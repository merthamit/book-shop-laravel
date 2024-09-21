@extends('front.layouts.master')
@section('title','Adres')
@section('content')
	<!-- ================ start banner area ================= -->
	<section class="blog-banner-area" id="category">
		<div class="container h-100">
			<div class="blog-banner">
				<div class="text-center">
					<h1>Ürün Ödemesi</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Anasayfa</a></li>
              <li class="breadcrumb-item active" aria-current="page">Ürün Ödemesi</li>
            </ol>
          </nav>
				</div>
			</div>
    </div>
	</section>
	<!-- ================ end banner area ================= -->


  <!--================Checkout Area =================-->
  <section class="checkout_area section-margin--small">
    <div class="container">
        <form action="{{route('checkout.steptwo')}}" method="POST">
        @csrf
        <div class="billing_details">
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{$error}}
                    @endforeach
                </div>
            @endif
            <div class="row">
                <div class="col-lg-8">
                    <h3>Ödeme Detayları</h3>
                    <div class="row contact_form">
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" placeholder="İsim" id="first" name="name">
                            <span class="placeholder" data-placeholder="First name"></span>
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" placeholder="Soyisim" class="form-control" id="last" name="lastname">
                            <span class="placeholder" data-placeholder="Last name"></span>
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" placeholder="Telefon Numarası" class="form-control" id="number" name="phone">
                            <span class="placeholder" data-placeholder="Phone number"></span>
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email Adresi">
                            <span class="placeholder" data-placeholder="Email Address"></span>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <select class="country_select" name="country">
                                <option value="turkiye">Türkiye</option>
                                <option value="germany">Almanya</option>
                                <option value="usa">Amerika</option>
                            </select>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="add1" name="add1" placeholder="Birinci adres satırı">
                            <span class="placeholder" data-placeholder="Address line 01"></span>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="add2" name="add2" placeholder="İkinci adres satırı">
                            <span class="placeholder" data-placeholder="Address line 02"></span>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="city" name="city" placeholder="Şehir">
                            <span class="placeholder" data-placeholder="Town/City"></span>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control"  id="zip" name="postcode" placeholder="Posta kodu">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="order_box">
                        <h2>Sipariş</h2>
                        <ul class="list">
                            <li><a href="#"><h4>Product <span>Total</span></h4></a></li>
                            @foreach ($items as $item)

                            <li><a href="#">{{$item->title}} <span class="middle">x {{$item->quantity}}</span> <span class="last">${{$item->price}}</span></a></li>
                            @endforeach
                        </ul>
                        <ul class="list list_2">
                            <li><a href="#">Toplam <span>${{$total}}</span></a></li>
                            <input type="hidden" value="{{$total}}" name="total" />
                            <li><a href="#">Kargo <span>Kargo Ücreti: $50.00</span></a></li>
                            <li><a href="#">Toplam kargo ile <span>${{$total + 50}}</span></a></li>
                        </ul>
                        <div class="creat_account">
                            <input type="checkbox" id="f-option4" name="selector">
                            <label for="f-option4">I’ve read and accept the </label>
                            <a href="#">terms & conditions*</a>
                        </div>
                        <div class="text-center">
                          <button class="button button-paypal" type="submit">Ödemeyi yap</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
  </section>
  <!--================End Checkout Area =================-->

@endsection
