<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\TypeOrder;

class OrderController extends Controller
{
    public function Index() {
        $order = Order::all();
        return view('home.orders.index', compact('order'));
    }

    public function NewOrder() {
        $type_orders = TypeOrder::all();
        return view('home.orders.new', compact('type_orders'));
    }

    public function AddNewOrder(Request $request) {
        $request->validate([
            'name'=>'required'
        ]);
        $order = new Order();

        $order->name = $request->name;
        $order->save();

        return redirect()->back()->with('success', 'Приказ успешно добавлена!');
    }

    public function Delete($id) {
        $order = Department::find($id);

        $order->delete();
        return redirect()->back()->with('success', 'Приказ успешно удалена!');
    }
}
