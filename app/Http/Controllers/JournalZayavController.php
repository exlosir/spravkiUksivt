<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Journal_zayav;
use App\status_zayav;
use Carbon\Carbon;

class JournalZayavController extends Controller
{
    public function getUnicNumber(Request $request) { //генерация уникального ID для заявки
        $timestamp = Carbon::now()->toDateTimeString();
        $ip = $request->ip();
        $timestamp = str_replace(['-',' ', ':'],'',$timestamp); // вырезаем из строки все лишние символы
        $ip = str_replace('.','',$ip); // вырезаем точки из ip
        $strlen = str_shuffle($timestamp.$ip); // перемешиваем рандомно строку
        $newstr = "";
        for($i = 0; $i <= strlen($strlen)/6;$i++) { // вставляем разделители
            $newstr .= substr($strlen,$i*2,4)."-";
        }
        return trim($newstr,"-"); // удаляем с начала и конца разделители если есть и возвращаем строку
    }

    public function Index() {
        $states = Journal_zayav::all();
        return view('home.statements.index', compact('states'));
    }

    public function NewStatement() {
        return view('home.statements.new', compact('spec', 'dep', 'order'));
    }

    public function AddNewStatement(Request $request) {
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

    public function SendZayav(Request $request){
        $request->validate([
            'fio'=>'required',
            'year'=>'required|integer|digits:4',
            'group'=>'required',
            'type_spravka'=>'required',
            'organization'=>'required'
        ]);  
        $zayav = new Journal_zayav();
        $fio = explode(" ", trim($request->fio));
        $identify = self::getUnicNumber($request);

        $zayav->identify = $identify;
        $zayav->familiya = $fio[0];
        $zayav->imya = $fio[1];
        $zayav->otchestvo = $fio[2];
        $zayav->year = $request->year;
        $zayav->group_id = $request->group;
        $zayav->type_id = $request->type_spravka;
        $zayav->Organization = $request->organization;
        $zayav->status = status_zayav::where('name', 'Принята')->get()->first()->id;
        $zayav->created_at = Carbon::now();
        $zayav->updated_at = Carbon::now();

        $zayav->save();

        return redirect()->back()->with('success', 'Ваша заявка успешно принята! Ваш идентификационный номер - <b>'. $identify . '</b>');

    }

    public function GetStatus(Request $request){
        $request->validate([
            'code'=>'required'
        ]);
        $zayav = Journal_zayav::firstOrFail()->where('identify',$request->code)->get()->first();
        // dd($zayav);
        return view('full_status', compact('zayav'));
    }
}
