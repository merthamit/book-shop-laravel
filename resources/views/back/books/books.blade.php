@extends('back.layouts.master')
@section('title', 'Kitaplar')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Kitaplar</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Resim</th>
                                <th>Kitap İsmi</th>
                                <th>Yazar</th>
                                <th>Kategori</th>
                                <th>Fiyat</th>
                                <th style="width: 10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                                <tr>
                                    <td><img src="{{ $book->image }}" style="width: 40%" /></td>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->author }}</td>
                                    <td>{{ $book->getCategory->title }}</td>
                                    <td>${{ $book->price }}</td>
                                    <td>
                                        <div class="form-button-action">
                                            <a href="{{ route('books.update', $book->id) }}" data-bs-toggle="tooltip"
                                                title="" class="btn btn-link btn-primary btn-lg"
                                                data-original-title="Edit Task">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{ route('books.delete', $book->id) }}" data-bs-toggle="tooltip"
                                                title="" class="btn btn-link btn-danger remove"
                                                data-original-title="Remove">
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
                text: "Bu kitap silinecek emin misin?",
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
