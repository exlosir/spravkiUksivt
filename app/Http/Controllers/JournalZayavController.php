<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Journal_zayav;

class JournalZayavController extends Controller
{
    public function Index() {
        $states = Journal_zayav::all();
        return view('home.statements.index', compact('states'));
    }

    public function NewGroup() {
        return view('home.statements.new', compact('spec', 'dep', 'order'));
    }

    public function AddNewGroup(Request $request) {
        $request->validate([
            'number'=>'required|integer',
            'year'=>'required|integer',
            'spec'=>'required',
            'dep'=>'required',
            'order'=>'required'
        ]);
        $grp = new Journal_zayav();
        $grp->number = $request->number;
        $grp->year = $request->year;
        $grp->specialty_id = $request->spec;
        $grp->department_id = $request->dep;
        $grp->order_id = $request->order;
        $grp->save();
        return redirect()->back()->with('success', 'Группа успешно добавлена!');
    }

    public function Delete($id) {
        $grp = Journal_zayav::find($id);
        $grp->delete();
        return redirect()->back()->with('success', 'Группа успешно удалена!');
    }

    // public function SendZayav(Request $request){
    //     $request->validate([
    //         'fio'=>'required',
    //         'year'=>'required',
    //         'group'=>'required',
    //         'organization'=>'required',
    //         'area'=>'required',
    //         'department'=>'required',
    //         'osn_obuch'=>'required'
    //     ]);
    //     dd($request);
    //     $spravka = new Journal_zayav();
    //     $arrFio = explode(" ", $request->fio);
    //     $spravka->Familiya = $arrFio[0];
    //     $spravka->Imya = $arrFio[1];
    //     $spravka->Otchestvo = $arrFio[2];
    //     $spravka->year = $request->year;
    //     dd($request->input('group'));
    //     $spravka->year = $request->year;
    //     $spravka->year = $request->year;

        
    // }

    public function GetStatus(Request $request){
        
    }
}
