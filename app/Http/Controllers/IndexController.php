<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Department;

class IndexController extends Controller
{
    public function ShowIndexPage(Request $request) {
        $currentTime = Carbon::now()->toDateTimeString();
        $ip = $request->ip();
        $string = self::getUnicNumber($currentTime, $ip);
        return view('index', ['time'=> $currentTime, 'ip'=>$ip, 'string'=>$string]);
    }

    public function ShowSpravkaPage(Request $request) {
        if($request->ajax()){
            $department = Department::all();
            return $department;
        }else
            return view('spravka');
    }

    public function ShowStatusPage() {
        return view('status');
    }

    public function getUnicNumber($timestamp, $ip) { //генерация уникального ID для заявки
        $timestamp = str_replace(['-',' ', ':'],'',$timestamp); // вырезаем из строки все лишние символы
        $ip = str_replace('.','',$ip); // вырезем точки из ip
        $strlen = str_shuffle($timestamp.$ip); // перемешиваем рандомно строку
        $newstr = "";
        for($i = 0; $i <= strlen($strlen)/6;$i++) { // вставляем разделители
            $newstr .= substr($strlen,$i*2,4)."-";
        }
        return trim($newstr,"-"); // удаляем с начала и конца разделители если есть и возвращаем строку
    }
}
