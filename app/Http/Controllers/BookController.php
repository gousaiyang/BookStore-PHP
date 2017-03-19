<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Validator;

use App\Book;
use App\Services\Money;

class BookController extends Controller
{
    public function getAllBooks()
    {
        $all_books = Book::all();
        foreach ($all_books as $book) {
            $book->price = Money::toYuan($book->price);
        }
        return view('book')->with('all_books', $all_books);
    }

    public function addBook(Request $request)
    {
        $inputs = $request->all();
        $validator = Validator::make(
            $inputs,
            [
                'name' => 'required',
                'price' => ['required', 'regex:/^[0-9]+(?:\.[0-9]{1,2})?$/']
            ],
            [],
            [
                'name' => '书名',
                'price' => '单价'
            ]
        );
        if ($validator->fails()) {
            return Response::json(['result' => 'failed', 'msg' => $validator->messages()->first()]);
        }
        $new_book = new Book;
        $new_book->name = $inputs['name'];
        $new_book->price = Money::toFen(floatval($inputs['price']));
        if (!$new_book->save()) {
            return Response::json(['result' => 'failed', 'msg' => '数据库写入失败']);
        }
        return Response::json(['result' => 'success', 'id' => $new_book->id]);
    }

    public function updateBook(Request $request)
    {
        $inputs = $request->all();
        $validator = Validator::make(
            $inputs,
            [
                'id' => 'required|integer|min:0',
                'name' => 'required',
                'price' => ['required', 'regex:/^[0-9]+(?:\.[0-9]{1,2})?$/']
            ],
            [],
            [
                'id' => '编号',
                'name' => '书名',
                'price' => '单价'
            ]
        );
        if ($validator->fails()) {
            return Response::json(['result' => 'failed', 'msg' => $validator->messages()->first()]);
        }
        $the_book = Book::find($inputs['id']);
        if (!$the_book) {
            return Response::json(['result' => 'failed', 'msg' => '该书籍编号不存在']);
        }
        $the_book->name = $inputs['name'];
        $the_book->price = Money::toFen(floatval($inputs['price']));
        if (!$the_book->save()) {
            return Response::json(['result' => 'failed', 'msg' => '数据库写入失败']);
        }
        return Response::json(['result' => 'success']);
    }

    public function deleteBook(Request $request)
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
        $the_book = Book::find($inputs['id']);
        if (!$the_book) {
            return Response::json(['result' => 'failed', 'msg' => '该书籍编号不存在']);
        }
        if (!$the_book->delete()) {
            return Response::json(['result' => 'failed', 'msg' => '删除失败']);
        }
        return Response::json(['result' => 'success']);
    }
}
