@extends('layout')

@section('title', '在线书店管理系统 - 书籍管理')

@section('content')

@include('navbar')

<div class="container">
    <h1>书籍管理
        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addDialog">
            <span class="glyphicon glyphicon-plus"></span>
        </button>
    </h1>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>编号</th>
                    <th>书名</th>
                    <th>单价</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            @foreach($all_books as $book)
                <tr id="{{ 'book-' . $book->id }}">
                    <th scope="row" class="col-md-2">{{ $book->id }}</th>
                    <td class="col-md-6">{{ $book->name }}</td>
                    <td class="col-md-2">{{ $book->price }}</td>
                    <td class="col-md-2">
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#updateDialog" data-id="{{ $book->id }}">
                            <span class="glyphicon glyphicon-edit"></span>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteDialog" data-id="{{ $book->id }}">
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
                    <h4 class="modal-title" id="addDialogLabel">添加书籍</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="addBookName" class="col-sm-2 control-label">书名</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="addBookName" placeholder="书籍名称">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="addBookPrice" class="col-sm-2 control-label">单价</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon">&#65509;</span>
                                    <input type="text" class="form-control" id="addBookPrice" placeholder="书籍单价">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" id="btnAddBook">添加</button>
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
                    <h4 class="modal-title" id="updateDialogLabel">修改书籍信息</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="updateBookId" class="col-sm-2 control-label">编号</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="updateBookId" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="updateBookName" class="col-sm-2 control-label">书名</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="updateBookName" placeholder="书籍名称">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="updateBookPrice" class="col-sm-2 control-label">单价</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon">&#65509;</span>
                                    <input type="text" class="form-control" id="updateBookPrice" placeholder="书籍单价">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal" id="btnUpdateBook">修改</button>
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
                    <h4 class="modal-title" id="deleteDialogLabel">删除书籍</h4>
                </div>
                <div class="modal-body">
                    <p id="deleteText"></p>
                    <input type="text" class="form-control hidden" id="deleteBookId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="btnDeleteBook">删除</button>
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
$('#btnAddBook').click(function() {
    var newName = $('#addBookName').val();
    var newPrice = $('#addBookPrice').val();
    var postData = {
        'name': newName,
        'price': newPrice
    };
    var alertSuccessHTML = '<div class="alert alert-success alert-dismissable fade in" role="alert">';
    var alertFailHTML = '<div class="alert alert-danger alert-dismissable" role="alert">';
    var alertDismissHTML = '<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
    $.post('/book/add', postData, function (data, status) {
        $('.alert').remove();
        if (data.result == 'success') {
            $('h1').after(alertSuccessHTML + '添加书籍成功！' + alertDismissHTML);
            $('#addBookName').val('');
            $('#addBookPrice').val('');
            $('tbody').append('<tr id="book-'+ data.id +'">  \
                    <th scope="row" class="col-md-2">' + data.id + '</th>  \
                    <td class="col-md-6">' + newName + '</td>  \
                    <td class="col-md-2">' + parseFloat(newPrice).toFixed(2) + '</td>  \
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
    var updateName = $('#book-' + updateId).children().first().next().text();
    var updatePrice = $('#book-' + updateId).children().first().next().next().text();
    $('#updateBookId').val(updateId);
    $('#updateBookName').val(updateName);
    $('#updateBookPrice').val(updatePrice);
});

$('#btnUpdateBook').click(function() {
    var id = $('#updateBookId').val();
    var newName = $('#updateBookName').val();
    var newPrice = $('#updateBookPrice').val();
    var postData = {
        'id': id,
        'name': newName,
        'price': newPrice
    };
    var alertSuccessHTML = '<div class="alert alert-info alert-dismissable fade in" role="alert">';
    var alertFailHTML = '<div class="alert alert-danger alert-dismissable" role="alert">';
    var alertDismissHTML = '<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
    $.post('/book/update', postData, function (data, status) {
        $('.alert').remove();
        $('html, body').animate({scrollTop: 0}, 'slow');
        if (data.result == 'success') {
            $('h1').after(alertSuccessHTML + '修改书籍信息成功！' + alertDismissHTML);
            $('#book-' + id).children().first().next().text(newName);
            $('#book-' + id).children().first().next().next().text(parseFloat(newPrice).toFixed(2));
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
    var deleteName = $('#book-' + deleteId).children().first().next().text();
    $('#deleteBookId').val(deleteId);
    $('#deleteText').html('您确实要删除编号为 <strong>' + deleteId + '</strong> 的书籍 <strong>' + deleteName + '</strong> 吗？');
});

$('#btnDeleteBook').click(function() {
    var id = $('#deleteBookId').val();
    var postData = {
        'id': id,
    };
    var alertSuccessHTML = '<div class="alert alert-warning alert-dismissable fade in" role="alert">';
    var alertFailHTML = '<div class="alert alert-danger alert-dismissable" role="alert">';
    var alertDismissHTML = '<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
    $.post('/book/delete', postData, function (data, status) {
        $('.alert').remove();
        $('html, body').animate({scrollTop: 0}, 'slow');
        if (data.result == 'success') {
            $('h1').after(alertSuccessHTML + '删除书籍成功！' + alertDismissHTML);
            $('#book-' + id).remove();
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
