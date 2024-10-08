@extends('front.layouts.master')
@section('title', 'Bize Ulaşın')
@section('content')
    <!-- ================ contact section start ================= -->
    <section class="section-margin--small">
        <div class="container">
            <div class="d-none d-sm-block mb-5 pb-4">
                <div id="map" style="height: 420px;"></div>
                <script>
                    function initMap() {
                        var uluru = {
                            lat: -25.363,
                            lng: 131.044
                        };
                        var grayStyles = [{
                                featureType: "all",
                                stylers: [{
                                        saturation: -90
                                    },
                                    {
                                        lightness: 50
                                    }
                                ]
                            },
                            {
                                elementType: 'labels.text.fill',
                                stylers: [{
                                    color: '#A3A3A3'
                                }]
                            }
                        ];
                        var map = new google.maps.Map(document.getElementById('map'), {
                            center: {
                                lat: -31.197,
                                lng: 150.744
                            },
                            zoom: 9,
                            styles: grayStyles,
                            scrollwheel: false
                        });
                    }
                </script>
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpfS1oRGreGSBU5HHjMmQ3o5NLw7VdJ6I&callback=initMap">
                </script>

            </div>


            <div class="row">
                <div class="col-md-12">
                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="col-md-4 col-lg-3 mb-4 mb-md-0">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-home"></i></span>
                        <div class="media-body">
                            <h3>{{ $footer->address }}</h3>
                            <p>{{ $footer->address }}</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-headphone"></i></span>
                        <div class="media-body">
                            <h3><a href="tel:454545654">{{ $footer->phone }}</a></h3>
                            <p>Pazartesi ve cuma günleri arası hergün.</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-email"></i></span>
                        <div class="media-body">
                            <h3><a href="mailto:support@colorlib.com">{{ $footer->email }}</a></h3>
                            <p>İstediğiniz zaman mail atın.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-lg-9">
                    <form action="{{ route('contact.add') }}" class="form-contact contact_form" method="post"
                        id="contactForm" novalidate="novalidate">
                        @csrf
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <input class="form-control" name="name" id="name" type="text"
                                        placeholder="Adınızı girin.">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="email" id="email" type="email"
                                        placeholder="Email adresinizi girin.">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="subject" id="subject" type="text"
                                        placeholder="Konuyu girin.">
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <textarea class="form-control different-control w-100" name="content" id="message" cols="30" rows="5"
                                        placeholder="Mesajı girin."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center text-md-right mt-3">
                            <button type="submit" class="button button--active button-contactForm">Mesaj gönder</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->

@endsection
