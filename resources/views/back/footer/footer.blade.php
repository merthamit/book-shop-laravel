@extends('back.layouts.master')
@section('title', 'Footer Düzenleme')
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
            <form action="{{ route('footer.update') }}" method="POST" id="myForm">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">@yield('title')</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="header">Email</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                        placeholder="Büyük header giriniz." value="{{ $footer->email }}" />
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="medium_header">Adres</label>
                                    <input type="text" name="address" class="form-control" id="medium_header"
                                        placeholder="Orta header giriniz." value="{{ $footer->address }}" />
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="header">Telefon</label>
                                    <input type="text" name="phone" class="form-control" id="header"
                                        placeholder="Büyük header giriniz." value="{{ $footer->phone }}" />
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="comment">Misyon</label>
                                    <textarea class="form-control" name="mission" id="comment" rows="5" spellcheck="false">{{ $footer->mission }}</textarea>
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
