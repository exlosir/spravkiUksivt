<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Journal_zayav;
use App\journal_spravok;
use App\status_zayav;
use Carbon\Carbon;
use Auth;

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

    public function Index(Request $request) {
        $auth = Auth::user();
        $isAdmin = false;
        foreach ($auth->roles as $role)
            if($role->name == 'Администратор')
                $isAdmin = true;
            if($isAdmin)
                $statements = Journal_zayav::orderBy('created_at','desc')->get();
            else
                $statements = Journal_zayav::whereHas('groups', function($query){
                    $auth = Auth::user();
                    $query->where('department_id',$auth->department_id);
                })->orderBy('id','desc')->get();
        return view('home.statements.index', compact('statements'));
    }

    public function IndexSorted($field_sort) {
        $auth = Auth::user();
        $isAdmin = false;
        foreach ($auth->roles as $role)
            if($role->name == 'Администратор')
                $isAdmin = true;

        switch($field_sort){
            case 'new': {
                $field_sort = 'Принята';
                break;
            }
            case 'accept': {
                $field_sort = 'Готова';
                break;
            }
            case 'decline': {
                $field_sort = 'Отклонена';
                break;
            }
            case 'signature': {
                $field_sort = 'На подписи';
                break;
            }
        }

        if($isAdmin)
            $statements = Journal_zayav::where('status',status_zayav::where('name',$field_sort)->get()->first()->id)->orderBy('created_at','desc')->get();
        else
            $statements = Journal_zayav::whereHas('groups',function($query){
                $auth = Auth::user();
                $query->where('department_id',$auth->department_id);
            })->where('status',status_zayav::where('name',$field_sort)->get()->first()->id)->orderBy('created_at','desc')->get();
        return view('home.statements.index', compact('statements'));
    }

    public function Chstatus(Request $request) {
        $zayav = Journal_zayav::find($request->id);
        $status = "";
        switch($request->status){
            case 'accept': {
                $status = 'Готова';
                break;
            }
            case 'decline': {
                $status = 'Отклонена';
                break;
            }
            case 'signature': {
                $status = 'На подписи';
                break;
            }
        }
        if($status == 'На подписи') {
            $zayav->status = status_zayav::where('name',$status)->get()->first()->id;
            $spravka = New journal_spravok();
            $spravka->zayav_id = $request->id;
            $spravka->date = \Carbon\Carbon::now();
            
        }
        else
            $zayav->status = status_zayav::where('name',$status)->get()->first()->id;
        $zayav->save();
        $spravka->save();
        return  redirect()->back()->with('success', 'Статус успешно изменен на '. $status);
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
        return view('full_status', compact('zayav'));
    }
}
