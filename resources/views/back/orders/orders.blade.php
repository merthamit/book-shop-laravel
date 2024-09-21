@extends('back.layouts.master')
@section('title', 'Siparişler')
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
                                <th>Sipariş Id</th>
                                <th>Sipariş Verenin İsmi</th>
                                <th>Telefon Numarası</th>
                                <th>Oluşturma Tarihi</th>
                                <th>Fiyat</th>
                                <th style="width: 10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->getUserName->name }}</td>
                                    <td>{{ $order->phone }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>${{ $order->total }}</td>
                                    <td>
                                        <div class="form-button-action">
                                            <a href="{{ route('order.cancel', $order->id) }}" data-bs-toggle="tooltip"
                                                title="" class="btn btn-danger btn-sm remove"
                                                data-original-title="Remove">
                                                İptal Et
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
                text: "Bu sipariş silinecek emin misin?",
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
