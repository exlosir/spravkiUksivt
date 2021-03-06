<?php

namespace App\Http\Controllers;
use App\Department;

use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function Index() {
        $dep = Department::all();
        return view('home.departments.index', compact('dep'));
    }

    public function NewDep() {
        return view('home.departments.new');
    }

    public function AddNewDep(Request $request) {
        $request->validate([
            'name'=>'required'
        ]);
        $dep = new Department();

        $dep->name = $request->name;
        $dep->save();

        return redirect()->back()->with('success', 'Отделение успешно добавлена!');
    }

    public function EditDep($id) {
        $dep = Department::find($id);
        return view('home.departments.edit', compact('dep'));
    }

    public function ApplyEditDep(Request $request, $id) {
        $dep = Department::find($id);
        $dep->name = $request->name;

        $dep->save();
        return redirect()->back()->with('success', 'Отделение успешно измененена!');
    }

    public function Delete($id) {
        $spec = Department::find($id);

        $spec->delete();
        return redirect()->back()->with('success', 'Отделение успешно удалена!');
    }
}
