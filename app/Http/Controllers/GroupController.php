<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Department;
use App\Specialty;
use App\Order;

class GroupController extends Controller
{
    public function Index() {
        $grp = Group::all();
        return view('home.groups.index', compact('grp'));
    }

    public function NewGroup() {
        $spec = Specialty::all();
        $dep = Department::all();
        $order = Order::all();
        return view('home.groups.new', compact('spec', 'dep', 'order'));
    }

    // public function AddNewGroup(Request $request) {
    //     $request->validate([
    //         'name'=>'required'
    //     ]);
    //     $grp = new Group();

    //     $grp->name = $request->name;
    //     $grp->save();

    //     return redirect()->back()->with('success', 'Группа успешно добавлена!');
    // }

    // public function Delete($id) {
    //     $grp = Group::find($id);

    //     $grp->delete();
    //     return redirect()->back()->with('success', 'Группа успешно удалена!');
    // }
}
