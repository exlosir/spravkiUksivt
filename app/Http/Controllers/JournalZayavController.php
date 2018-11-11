<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Journal_zayav;

class JournalZayavController extends Controller
{
    public function ShowAllZayav(){

    }

    public function SendZayav(Request $request){
        // $request->validate([
        //     'fio'=>'required',
        //     'year'=>'required',
        //     'group'=>'required',
        //     'organization'=>'required',
        //     'area'=>'required',
        //     'department'=>'required',
        //     'osn_obuch'=>'required'
        // ]);
        // dd($request);
        // $spravka = new Journal_zayav();
        // $arrFio = explode(" ", $request->fio);
        // $spravka->Familiya = $arrFio[0];
        // $spravka->Imya = $arrFio[1];
        // $spravka->Otchestvo = $arrFio[2];
        // $spravka->year = $request->year;
        dd($request->input('group'));
        $spravka->year = $request->year;
        $spravka->year = $request->year;

        
    }

    public function GetStatus(Request $request){
        
    }
}
