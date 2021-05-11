<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Order::all();
        return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $items = $request->json()->all();

        foreach ($items as $item) {
            $stok = Item::where('id', $item['item_id'])->get()[0];
            Item::where('id', $item['item_id'])->update(['stok' => $stok['stok']-$item['total_order']]);
            Order::create($item);
        }

        return $items;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Order::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $result = Order::find($id)->update($request->all());
        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Order::destroy($id);
        return $result;
    }

    public function checkout(Request $request)
    {
        $orderKey = $request->all()["key"];
        $result = Order::where('order_key', $orderKey)->update(['status' => 'CHECKOUT']);
        return $result;
    }

    public function currentMonth() {
        $result = Order::select('users.name', 'users.phone', 'orders.order_key', 'orders.created_at', DB::raw('SUM(items.price * orders.total_order) AS sum_income'))->join('users', 'users.id', '=', 'orders.user_id')->join('items', 'items.id', '=', 'orders.item_id')->whereMonth('orders.created_at', Carbon::now()->month)->groupBy('users.name', 'users.phone', 'orders.order_key', 'orders.created_at')->get();

        return $result;
    }

    public function currentYear() {
        $result = Order::select('users.name', 'users.phone', 'orders.order_key', 'orders.created_at', DB::raw('SUM(items.price * orders.total_order) AS sum_income'))->join('users', 'users.id', '=', 'orders.user_id')->join('items', 'items.id', '=', 'orders.item_id')->whereYear('orders.created_at', Carbon::now()->year)->groupBy('users.name', 'users.phone', 'orders.order_key', 'orders.created_at')->get();

        return $result;
    }

    public function summaryAll() {
        $result = Order::select('users.name', 'users.phone', 'orders.order_key', 'orders.created_at', DB::raw('SUM(items.price * orders.total_order) AS sum_income'))->join('users', 'users.id', '=', 'orders.user_id')->join('items', 'items.id', '=', 'orders.item_id')->groupBy('users.name', 'users.phone', 'orders.order_key', 'orders.created_at')->get();

        return $result;
    }
}
