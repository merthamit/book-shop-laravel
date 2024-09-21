@extends('front.layouts.master')
@section('title', 'Siparişlerim')
@section('content')
<div class="container px-4 mt-4">


    @if (count($userOrders) == 0)
        <div class="alert alert-warning">Hiç siparişiniz yok.</div>
    @endif
    @foreach ($userOrders as $order)
    <!-- Payment methods card-->

    <div class="card card-header-actions mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="d-flex">
                <div>
                    Sipariş tutarı
                    <div>
                        ${{$order->total}}
                    </div>
                </div>
                <div class="ml-4">
                    Sipariş Tarihi
                    <div>
                        {{\Carbon\Carbon::parse($order->created_at)->format('d.m.Y')}}
                    </div>
                </div>
            </div>
            <a href="{{route('my.orders.delete', $order->id)}}" class="btn btn-danger">Sipariş İptali</a>
        </div>
        <div class="card-body px-0">
            <!-- Payment method 1-->
            @foreach (json_decode($order->items) as $item)
                <div class="d-flex align-items-center justify-content-between px-4">
                    <div class="d-flex align-items-center">
                        <div style="width:90px; height:90px;">
                            <img class="img-thumbnail w-100" src="{{$item->image}}" />
                        </div>
                        <div class="ms-4 ml-2">
                            <div class="small">${{$item->price}} x {{$item->quantity}}</div>
                            <a href="{{route('single', $item->item_id)}}" class="text-xs text-muted text-decoration-underline">{{$item->title}}</a>
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
    </div>

    @endforeach
</div>
@endsection
