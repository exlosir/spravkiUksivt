<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\TypeOrder;
use App\Student;

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
        $student = Student::all();
        $order = Order::all();
        $type = TypeOrder::all();
        // $ord = Order::all();
        // dd($ord->find(5)->student->first()->order_student->type_orders->name);
        return view('home.orders.order_student', compact('student', 'type', 'order'));
    }

    public function FindStudent(Request $reqest) {
        if(!($reqest->search == null)) {
        $search = explode(' ', $reqest->search);
        $students = Student::with('groups', 'groups.specialties')->where(function ($q) use ($search){
            foreach($search as $item) {
                $q->orWhere('familiya', 'like',"%{$item}%")->
                orWhere('imya', 'like',"%{$item}%")->
                orWhere('otchestvo', 'like',"%{$item}%")->
                orWhere('year', 'like',"%{$item}%");
            }
        })->get();
        }else {
            $students = Student::with('groups', 'groups.specialties')->get();
        }
        $response = array(
            'status'=>'success',
            'students'=>$students,
        );

        return response()->json($response);
    }

    public function AddNewStudentOrder(Request $request) {
        $request->validate([
            'student'=>'required',
            'order'=>'required',
            'type'=>'required',
        ]);

        $order = Order::find($request->order);
        $order->student()->attach($request->student, array('type'=>$request->type));
        return redirect()->back()->with('success', 'Что-то успешно сделано!');
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
