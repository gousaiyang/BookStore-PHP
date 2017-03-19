<?php

namespace App\Http\Controllers;

use DB;

class OrderController extends Controller
{
    public function getAllOrders()
    {
        $all_orders = DB::select(DB::raw('select orders.id as order_id, nickname, books.name as bookname, quantity, format(quantity * price / 100, 2) as total_price, orders.created_at as order_time from orders, users, books where orders.uid = users.id and orders.bid = books.id'));
        
        /*$all_books = Book::all();
        foreach ($all_books as $book) {
            $book->price = Money::toYuan($book->price);
        }*/
        return view('order')->with('all_orders', $all_orders);
    }
}
