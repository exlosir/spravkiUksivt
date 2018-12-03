<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Types_spravka;

class TypesSpravkaController extends Controller
{
    public function Index() {
        $type = Types_spravka::all();
        return view('home.type_spravka.index', compact('type'));
    }

    public function NewType() {
        return view('home.type_spravka.new_type');
    }
    
    public function AddNewType(Request $request) {
        $type = new Types_spravka();

        $request->validate([
            'name'=>'required'
        ]);

        $type->name = $request->name;

        $type->save();

        return redirect()->back()->with('success', 'Успешно добавлено!');
    }

    public function Delete($id) {
        $type = Types_spravka::find($id);

        $type->delete();

        return redirect()->back()->with('success', 'Успешно удалено!');
    }
}
