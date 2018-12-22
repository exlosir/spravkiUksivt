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

    public function AddNewGroup(Request $request) {
        $request->validate([
            'number'=>'required|integer',
            'year'=>'required|integer',
            'spec'=>'required',
            'dep'=>'required',
            'order'=>'required'
        ]);
        $grp = new Group();
        $grp->number = $request->number;
        $grp->year = $request->year;
        $grp->specialty_id = $request->spec;
        $grp->department_id = $request->dep;
        $grp->order_id = $request->order;
        $grp->save();
        return redirect()->back()->with('success', 'Группа успешно добавлена!');
    }
    
    public function EditGroup($id) {
        $group = Group::find($id);
        $spec = Specialty::all();
        $dep = Department::all();
        $order = Order::all();
        return view('home.groups.edit', compact('group', 'spec', 'dep', 'order'));
    }

    public function ApplyEditGroup(Request $request, $id) {
        $group = Group::find($id);
        $group->number = $request->number;
        $group->year = $request->year;
        $group->specialty_id = $request->specialty;
        $group->department_id = $request->department;
        $group->order_id = $request->order;

        $group->save();
        return redirect()->back()->with('success', 'Группа успешно изменен!');
    }

    public function Delete($id) {
        $grp = Group::find($id);
        $grp->delete();
        return redirect()->back()->with('success', 'Группа успешно удалена!');
    }
}
