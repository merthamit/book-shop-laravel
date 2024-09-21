@extends('back.layouts.master')
@section('title', 'Yorumlar')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div class="card-title">@yield('title')</div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Yorum Id</th>
                                <th>Yorum Yapan Kişi</th>
                                <th>Kitap İsmi</th>
                                <th>Yorum</th>
                                <th>Puan</th>
                                <th>Olışturulma Tarihi</th>
                                <th style="width: 10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comments as $comment)
                                <tr>
                                    <td>{{ $comment->id }}</td>
                                    <td>{{ $comment->getUserName->name }}</td>
                                    <td>{{ $comment->getBookName->title }}</td>
                                    <td>{{ $comment->comment }}</td>
                                    <td>{{ $comment->rating }} <i class="fa fa-star" style="color: gold;"></i></td>
                                    <td>{{ $comment->created_at }}</td>
                                    <td>
                                        <div class="form-button-action">
                                            <a href="{{ route('comment.delete', $comment->id) }}" data-bs-toggle="tooltip"
                                                title="" class="btn btn-sm btn-danger remove"
                                                data-original-title="Remove">
                                                Sil
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
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            // Add Row
            $("#add-row").DataTable({
                pageLength: 10,
            });

        });
    </script>
    <script>
        $(".form-button-action .remove").on('click', function(e) {
            e.preventDefault(); // Formun otomatik olarak submit edilmesini engeller

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
@endsection
