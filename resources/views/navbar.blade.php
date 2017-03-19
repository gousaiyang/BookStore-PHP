<nav class="navbar bg-info">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">在线书店管理系统</a>
        <ul class="nav nav-tabs">
            <li role="presentation"><a href="{{ url('/book') }}"><span class="glyphicon glyphicon-book"></span> 书籍管理</a></li>
            <li role="presentation"><a href="{{ url('/order') }}"><span class="glyphicon glyphicon-list-alt"></span> 订单管理</a></li>
            <li role="presentation"><a href="{{ url('/user') }}"><span class="glyphicon glyphicon-user"></span> 用户管理</a></li>
        </ul>
    </div>
</nav>