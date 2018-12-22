<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Specialty;

class SpecialtyController extends Controller
{
    public function Index() {
        $spec = Specialty::all();
        return view('home.specialties.index', compact('spec'));
    }

    public function NewSpec() {
        return view('home.specialties.new');
    }

    public function AddNewSpec(Request $request) {
        $request->validate([
            'name'=>'required',
            'short_name'=>'required',
            'period_obuch'=>'required'
        ]);
        $spec = new Specialty();

        $spec->name = $request->name;
        $spec->short_name = $request->short_name;
        $spec->period_obuch = $request->period_obuch;
        $spec->save();

        return redirect()->back()->with('success', 'Специальность успешно добавлена!');
    }

    public function EditSpec($id) {
        $spec = Specialty::find($id);
        return view('home.specialties.edit', compact('spec'));
    }

    public function ApplyEditSpec(Request $request, $id) {
        $spec = Specialty::find($id);
        $spec->name = $request->name;
        $spec->short_name = $request->short_name;
        $spec->period_obuch = $request->period_obuch;

        $spec->save();
        return redirect()->back()->with('success', 'Специальность успешно измененена!');
    }

    public function Delete($id) {
        $spec = Specialty::find($id);

        $spec->delete();
        return redirect()->back()->with('success', 'Специальность успешно удалена!');
    }
    
}
