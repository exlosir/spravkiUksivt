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
        $type = TypeOrder::all();
        return view('home.orders.new', compact('type'));
    }

    public function NewStudentOrder() {
        return view('home.orders.order_student');
    }

    public function AddNewStudentOrder() {

    }

    public function AddNewOrder(Request $request) { 
        $request->validate([
            'number'=>'required|integer',
            'date'=>'required'
        ]);
        $order = new Order();

        $order->number = $request->number;
        $order->date = $request->date;
        $order->save();

        return redirect()->back()->with('success', 'Приказ успешно добавлен!');
    }

    public function EditOrder($id) {
        $order = Order::find($id);
        return view('home.orders.edit', compact('order'));
    }

    public function ApplyEditOrder(Request $request, $id) {
        $order = Order::find($id);
        $order->number = $request->number;
        $order->date = $request->date;

        $order->save();
        return redirect()->back()->with('success', 'Приказ успешно изменен!');
    }

    public function Delete($id) {
        $order = Order::find($id);

        $order->delete();
        return redirect()->back()->with('success', 'Приказ успешно удален!');
    }
}
