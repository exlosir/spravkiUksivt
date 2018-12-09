<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Department;
use App\student_osnova;
use App\Group;
use App\Types_spravka;

class IndexController extends Controller
{
    public function ShowIndexPage(Request $request) {
        
        $string = self::getUnicNumber($request);
        return view('index', ['string'=>$string]);
    }

    public function ShowSpravkaPage() {
        $types = Types_spravka::all();
        $groups = Group::all();
        $osn_obuch = student_osnova::all();
        $department = Department::all();
            return view('spravka', compact('department', 'osn_obuch', 'groups', 'types'));
    }

    public function ShowStatusPage() {
        return view('status');
    }

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
}
