<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Validator;

use App\BUser;

class UserController extends Controller
{
    public function getAllUsers()
    {
        $all_users = BUser::all();
        return view('user')->with('all_users', $all_users);
    }

    public function addUser(Request $request)
    {
        $inputs = $request->all();
        $validator = Validator::make(
            $inputs,
            [
                'username' => ['required', 'regex:/^[-_0-9a-zA-Z]{5,}$/', 'unique:users'],
                'nickname' => 'required'
            ],
            [
                'username.regex' => '用户名只能由字母、数字、破折号(-)和下划线(_)组成，且最小长度为 5 个字符。'
            ],
            [
                'username' => '用户名',
                'nickname' => '昵称'
            ]
        );
        if ($validator->fails()) {
            return Response::json(['result' => 'failed', 'msg' => $validator->messages()->first()]);
        }
        $new_user = new BUser;
        $new_user->username = $inputs['username'];
        $new_user->nickname = $inputs['nickname'];
        if (!$new_user->save()) {
            return Response::json(['result' => 'failed', 'msg' => '数据库写入失败']);
        }
        return Response::json(['result' => 'success', 'id' => $new_user->id]);
    }

    public function updateUser(Request $request)
    {
        $inputs = $request->all();
        $validator = Validator::make(
            $inputs,
            [
                'id' => 'required|integer|min:0',
                'username' => ['required', 'regex:/^[-_0-9a-zA-Z]{5,}$/'],
                'nickname' => 'required'
            ],
            [
                'username.regex' => '用户名只能由字母、数字、破折号(-)和下划线(_)组成，且最小长度为 5 个字符。'
            ],
            [
                'id' => '编号',
                'username' => '用户名',
                'nickname' => '昵称'
            ]
        );
        if ($validator->fails()) {
            return Response::json(['result' => 'failed', 'msg' => $validator->messages()->first()]);
        }
        $the_user = BUser::find($inputs['id']);
        if (!$the_user) {
            return Response::json(['result' => 'failed', 'msg' => '该用户编号不存在']);
        }
        if ($the_user->username != $inputs['username'] && BUser::where('username', '=', $inputs['username'])->count()) {
            return Response::json(['result' => 'failed', 'msg' => '用户名已存在']);
        }
        $the_user->username = $inputs['username'];
        $the_user->nickname = $inputs['nickname'];
        if (!$the_user->save()) {
            return Response::json(['result' => 'failed', 'msg' => '数据库写入失败']);
        }
        return Response::json(['result' => 'success']);
    }

    public function deleteUser(Request $request)
    {
        $inputs = $request->all();
        $validator = Validator::make(
            $inputs,
            [
                'id' => 'required|integer|min:0'
            ],
            [],
            [
                'id' => '编号'
            ]
        );
        if ($validator->fails()) {
            return Response::json(['result' => 'failed', 'msg' => $validator->messages()->first()]);
        }
        $the_user = BUser::find($inputs['id']);
        if (!$the_user) {
            return Response::json(['result' => 'failed', 'msg' => '该用户编号不存在']);
        }
        if (!$the_user->delete()) {
            return Response::json(['result' => 'failed', 'msg' => '删除失败']);
        }
        return Response::json(['result' => 'success']);
    }
}
