@extends('front.layouts.master')
@section('title', 'Siparişlerim')
@section('content')
    <div class="container mt-4 mb-4">
        <div class="row gutters">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="card ">
                    <div class="card-body">
                        <div class="account-settings">
                            <div class="user-profile">
                                <h5 class="user-name">{{ Auth::user()->name }}</h5>
                                <h6 class="user-email">{{ Auth::user()->email }}</h6>
                                @if (Auth::user()->usertype)
                                    <a href="{{ route('panel') }}" class="btn btn-sm btn-danger">Admin Paneli</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card ">
                    <div class="card-body">
                        <div class="account-settings">
                            <div class="nav flex-column nav-pills nav-secondary" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" href="#v-pills-home"
                                    role="tab" aria-controls="v-pills-home" aria-selected="true">Kişisel Detaylar</a>
                                <a class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" href="#v-pills-profile"
                                    role="tab" aria-controls="v-pills-profile" aria-selected="false"
                                    tabindex="-1">Yorumlar</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                        aria-labelledby="v-pills-home-tab">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row gutters">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <h6 class="mb-3 text-primary">Kişisel Detaylar</h6>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="fullName">İsim</label>
                                                <input type="text" class="form-control" name="name" id="fullName"
                                                    placeholder="İsminizi girin" value="{{ Auth::user()->name }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="eMail">Email</label>
                                                <input type="email" class="form-control" id="eMail"
                                                    placeholder="Enter email ID" name="email"
                                                    value="{{ Auth::user()->email }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="phone">Yeni Şifre</label>
                                                <input type="password" class="form-control" id="phone"
                                                    placeholder="Şifrenizi girin" name="new_password">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="phone">Yeni Şifre Tekrar</label>
                                                <input type="password" class="form-control" id="phone"
                                                    placeholder="Şifrenizi girin" name="new_password_confirm">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="phone">Eski Şifre</label>
                                                <input type="password" class="form-control" id="phone"
                                                    placeholder="Şifrenizi girin" name="old_password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row gutters">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="text-right">
                                                <button type="submit" id="submit" name="submit"
                                                    class="btn btn-primary">Güncelle</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h6 class="text-primary">Yorumlar</h6>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Kitap</th>
                                                    <th>Yorum</th>
                                                    <th>Puan</th>
                                                    <th style="width: 10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($userComments as $comment)
                                                    <tr>
                                                        <td>{{ $comment->getBookName->title }}</td>
                                                        <td>{{ $comment->comment }}</td>
                                                        <td>{{ $comment->rating }}</td>
                                                        <td>
                                                            <div class="form-button-action">
                                                                <a href="{{ route('single.comment.delete', $comment->id) }}"
                                                                    data-bs-toggle="tooltip" title=""
                                                                    class="btn  btn-danger btn-sm remove"
                                                                    data-original-title="Edit Task">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(".form-button-action .remove").on('click', function(e) {
            e.preventDefault(); // Formun otomatik olarak submit edilmesini engeller
            console.log(e)
            swal({
                title: 'Emin misiniz?',
                text: "Bu yorum silinecek emin misin?",
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
                    window.location.href = $(this).attr('href');
                }
            })
        });
    </script>
    <script src="{{ asset('back') }}/assets/js/plugin/sweetalert/sweetalert.min.js"></script>
@endsection
