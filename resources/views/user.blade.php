@extends('layout')

@section('title', '在线书店管理系统 - 用户管理')

@section('content')

@include('navbar')

<div class="container">
    <h1>用户管理
        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addDialog">
            <span class="glyphicon glyphicon-plus"></span>
        </button>
    </h1>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>编号</th>
                    <th>用户名</th>
                    <th>昵称</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            @foreach($all_users as $user)
                <tr id="{{ 'user-' . $user->id }}">
                    <th scope="row" class="col-md-2">{{ $user->id }}</th>
                    <td class="col-md-4">{{ $user->username }}</td>
                    <td class="col-md-4">{{ $user->nickname }}</td>
                    <td class="col-md-2">
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#updateDialog" data-id="{{ $user->id }}">
                            <span class="glyphicon glyphicon-edit"></span>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteDialog" data-id="{{ $user->id }}">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="addDialog" tabindex="-1" role="dialog" aria-labelledby="addDialogLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addDialogLabel">添加用户</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="addUserUsername" class="col-sm-2 control-label">用户名</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="addUserUsername" placeholder="用户名">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="addUserNickname" class="col-sm-2 control-label">昵称</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="addUserNickname" placeholder="昵称">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" id="btnAddUser">添加</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="updateDialog" tabindex="-1" role="dialog" aria-labelledby="updateDialogLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="updateDialogLabel">修改用户信息</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="updateUserId" class="col-sm-2 control-label">编号</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="updateUserId" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="updateUserUsername" class="col-sm-2 control-label">用户名</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="updateUserUsername" placeholder="用户名">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="updateUserNickname" class="col-sm-2 control-label">昵称</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="updateUserNickname" placeholder="昵称">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal" id="btnUpdateUser">修改</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteDialog" tabindex="-1" role="dialog" aria-labelledby="deleteDialogLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="deleteDialogLabel">删除用户</h4>
                </div>
                <div class="modal-body">
                    <p id="deleteText"></p>
                    <input type="text" class="form-control hidden" id="deleteUserId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="btnDeleteUser">删除</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>
</div>

@include('footer')

@endsection

@section('js-content')

<script>
$('#btnAddUser').click(function() {
    var newUsername = $('#addUserUsername').val();
    var newNickname = $('#addUserNickname').val();
    var postData = {
        'username': newUsername,
        'nickname': newNickname
    };
    var alertSuccessHTML = '<div class="alert alert-success alert-dismissable fade in" role="alert">';
    var alertFailHTML = '<div class="alert alert-danger alert-dismissable" role="alert">';
    var alertDismissHTML = '<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
    $.post('/user/add', postData, function (data, status) {
        $('.alert').remove();
        if (data.result == 'success') {
            $('h1').after(alertSuccessHTML + '添加用户成功！' + alertDismissHTML);
            $('#addUserUsername').val('');
            $('#addUserNickname').val('');
            $('tbody').append('<tr id="user-'+ data.id +'">  \
                    <th scope="row" class="col-md-2">' + data.id + '</th>  \
                    <td class="col-md-4">' + newUsername + '</td>  \
                    <td class="col-md-4">' + newNickname + '</td>  \
                    <td class="col-md-2">  \
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#updateDialog" data-id="' + data.id + '">  \
                            <span class="glyphicon glyphicon-edit"></span>  \
                        </button>  \
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteDialog" data-id="' + data.id + '">  \
                            <span class="glyphicon glyphicon-trash"></span>  \
                        </button>  \
                    </td>  \
                </tr>');
            setTimeout(function () {
                $('.alert-success').alert('close');
            }, 3000);
        }
        else {
            if (data.msg) {
                $('h1').after(alertFailHTML + '错误：' + data.msg + alertDismissHTML);
            }
            else {
                $('h1').after(alertFailHTML + '未知错误，请联系管理员。' + alertDismissHTML);
            }
        }
    }).fail(function (xhr, errorText, errorType) {
        $('.alert').remove();
        $('h1').after(alertFailHTML + '错误：' + errorType + '，请联系管理员。' + alertDismissHTML);
    });
});

$('#updateDialog').on('show.bs.modal', function (event) {
    var updateId = $(event.relatedTarget).data('id');
    var updateUsername = $('#user-' + updateId).children().first().next().text();
    var updateNickname = $('#user-' + updateId).children().first().next().next().text();
    $('#updateUserId').val(updateId);
    $('#updateUserUsername').val(updateUsername);
    $('#updateUserNickname').val(updateNickname);
});

$('#btnUpdateUser').click(function() {
    var id = $('#updateUserId').val();
    var newUsername = $('#updateUserUsername').val();
    var newNickname = $('#updateUserNickname').val();
    var postData = {
        'id': id,
        'username': newUsername,
        'nickname': newNickname
    };
    var alertSuccessHTML = '<div class="alert alert-info alert-dismissable fade in" role="alert">';
    var alertFailHTML = '<div class="alert alert-danger alert-dismissable" role="alert">';
    var alertDismissHTML = '<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
    $.post('/user/update', postData, function (data, status) {
        $('.alert').remove();
        $('html, body').animate({scrollTop: 0}, 'slow');
        if (data.result == 'success') {
            $('h1').after(alertSuccessHTML + '修改用户信息成功！' + alertDismissHTML);
            $('#user-' + id).children().first().next().text(newUsername);
            $('#user-' + id).children().first().next().next().text(newNickname);
            setTimeout(function () {
                $('.alert-info').alert('close');
            }, 3000);
        }
        else {
            if (data.msg) {
                $('h1').after(alertFailHTML + '错误：' + data.msg + alertDismissHTML);
            }
            else {
                $('h1').after(alertFailHTML + '未知错误，请联系管理员。' + alertDismissHTML);
            }
        }
    }).fail(function (xhr, errorText, errorType) {
        $('.alert').remove();
        $('html, body').animate({scrollTop: 0}, 'slow');
        $('h1').after(alertFailHTML + '错误：' + errorType + '，请联系管理员。' + alertDismissHTML);
    });
});

$('#deleteDialog').on('show.bs.modal', function (event) {
    var deleteId = $(event.relatedTarget).data('id');
    var deleteUsername = $('#user-' + deleteId).children().first().next().text();
    $('#deleteUserId').val(deleteId);
    $('#deleteText').html('您确实要删除用户名为 <strong>' + deleteUsername + '</strong> 的用户吗？');
});

$('#btnDeleteUser').click(function() {
    var id = $('#deleteUserId').val();
    var postData = {
        'id': id,
    };
    var alertSuccessHTML = '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
    var alertFailHTML = '<div class="alert alert-danger alert-dismissable" role="alert">';
    var alertDismissHTML = '<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
    $.post('/user/delete', postData, function (data, status) {
        $('.alert').remove();
        $('html, body').animate({scrollTop: 0}, 'slow');
        if (data.result == 'success') {
            $('h1').after(alertSuccessHTML + '删除用户成功！' + alertDismissHTML);
            $('#user-' + id).remove();
            setTimeout(function () {
                $('.alert-warning').alert('close');
            }, 3000);
        }
        else {
            if (data.msg) {
                $('h1').after(alertFailHTML + '错误：' + data.msg + alertDismissHTML);
            }
            else {
                $('h1').after(alertFailHTML + '未知错误，请联系管理员。' + alertDismissHTML);
            }
        }
    }).fail(function (xhr, errorText, errorType) {
        $('.alert').remove();
        $('html, body').animate({scrollTop: 0}, 'slow');
        $('h1').after(alertFailHTML + '错误：' + errorType + '，请联系管理员。' + alertDismissHTML);
    });
});
</script>

@endsection
