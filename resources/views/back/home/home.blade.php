@extends('back.layouts.master')
@section('title', 'Admin Paneli')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-secondary">
                <div class="card-body skew-shadow">
                    <h1>Sipariş Sayısı</h1>
                    <h5 class="op-8">Şu ana kadar açılan sipariş sayısı</h5>
                    <div class="pull-right">
                        <h3 class="fw-bold op-8">{{ $ordersCount }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-secondary">
                <div class="card-body skew-shadow">
                    <h1>Yorum sayısı</h1>
                    <h5 class="op-8">Şu ana kadar yapın yorum sayısı</h5>
                    <div class="pull-right">
                        <h3 class="fw-bold op-8">{{ $commentsCount }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-secondary">
                <div class="card-body skew-shadow">
                    <h1>Kitap Sayısı</h1>
                    <h5 class="op-8">Satılık olan kitap sayısı</h5>
                    <div class="pull-right">
                        <h3 class="fw-bold op-8">{{ $booksCount }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-secondary">
                <div class="card-body skew-shadow">
                    <h1>Üye Sayısı</h1>
                    <h5 class="op-8">Toplam üye sayısı</h5>
                    <div class="pull-right">
                        <h3 class="fw-bold op-8">{{ $userCount }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
