@extends('layout')

@section('title', '在线书店管理系统 - 首页')

@section('content')
<div class="container">
    <div class="jumbotron">
        <h1>在线书店管理系统 V1</h1>
        <p>欢迎使用在线书店管理系统！</p>
        <p>点击下方按钮，进入管理系统的各个模块。</p>
        <p>
            <a class="btn btn-primary btn-lg" href="{{ url('/book') }}" role="button"><span class="glyphicon glyphicon-book"></span> 书籍管理</a>
            <a class="btn btn-success btn-lg" href="{{ url('/order') }}" role="button"><span class="glyphicon glyphicon-list-alt"></span> 订单管理</a>
            <a class="btn btn-info btn-lg" href="{{ url('/user') }}" role="button"><span class="glyphicon glyphicon-user"></span> 用户管理</a>
        </p>
    </div>
</div>
@endsection
