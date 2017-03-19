@extends('layout')

@section('title', '在线书店管理系统 - 订单管理')

@section('content')

@include('navbar')

<div class="container">
    <h1>订单管理</h1>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>订单号</th>
                    <th>用户</th>
                    <th>书籍</th>
                    <th>数量</th>
                    <th>总价</th>
                    <th>创建时间</th>
                </tr>
            </thead>
            <tbody>
            @foreach($all_orders as $order)
                <tr>
                    <th scope="row" class="col-md-2">{{ $order->order_id }}</th>
                    <td class="col-md-2">{{ $order->nickname }}</td>
                    <td class="col-md-2">{{ $order->bookname }}</td>
                    <td class="col-md-2">{{ $order->quantity }}</td>
                    <td class="col-md-2">{{ $order->total_price }}</td>
                    <td class="col-md-2">{{ $order->order_time }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('footer')

@endsection