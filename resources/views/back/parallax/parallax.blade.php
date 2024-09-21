@extends('back.layouts.master')
@section('title', 'Parallax Düzenleme')
@section('content')

    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <form action="{{ route('parallax.update') }}" method="POST" id="myForm">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">@yield('title')</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="header">Büyük Header</label>
                                    <input type="text" name="header_big" class="form-control" id="header"
                                        placeholder="Büyük header giriniz." value="{{ $parallax->header_big }}" />
                                    <small id="emailHelp2" class="form-text text-muted">We'll never share your email with
                                        anyone
                                        else.</small>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="medium_header">Orta Header</label>
                                    <input type="text" name="header_medium" class="form-control" id="medium_header"
                                        placeholder="Orta header giriniz." value="{{ $parallax->header_medium }}" />
                                    <small id="emailHelp2" class="form-text text-muted">We'll never share your email with
                                        anyone
                                        else.</small>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="header">Button Adı</label>
                                    <input type="text" name="button_name" class="form-control" id="header"
                                        placeholder="Büyük header giriniz." value="{{ $parallax->button_name }}" />
                                    <small id="emailHelp2" class="form-text text-muted">We'll never share your email with
                                        anyone
                                        else.</small>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="comment">İçerik</label>
                                    <textarea class="form-control" name="header_small" id="comment" rows="5" spellcheck="false">{{ $parallax->header_small }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-success">Kaydet</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(".card-action button").on('click', function(e) {
            e.preventDefault(); // Formun otomatik olarak submit edilmesini engeller

            swal({
                title: 'Emin misiniz?',
                text: "Kayıt edilecek emin misin?",
                icon: 'warning',
                showCancelButton: true,
                buttons: {
                    confirm: {
                        text: "Evet",
                        className: "btn btn-success",
                    },
                    cancel: {
                        text: "İptal",
                        visible: true,
                        className: "btn btn-danger",
                    },
                },
            }).then((result) => {
                if (result) {
                    $('#myForm').submit(); // Kullanıcı onay verirse formu gönderir
                }
            })
        });
    </script>
@endsection
