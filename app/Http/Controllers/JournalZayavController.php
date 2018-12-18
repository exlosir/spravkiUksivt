<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Journal_zayav;
use App\journal_spravok;
use App\status_zayav;
use App\Student;
use Carbon\Carbon;
use Auth;

use PHPExcel; 
use PHPExcel_IOFactory;
use PHPExcel_Style_Border;

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

    public function getFIO($_FIO, $_gender){
        $gender = null;
        if($_gender == 'man')
            $gender = \NCL\NCL::$MAN;
        else
            $gender = \NCL\NCL::$WOMAN;
            
        $case = new \NCL\NCLNameCaseRu();
        $fio = explode(' ',$case->qFullName($_FIO['familiya'],$_FIO['imya'],$_FIO['otchestvo'], $gender, \NCL\NCL::$DATELN, "S N F"));
        return $fio;
    }

    public function createNepolnSpravka($zayav, $student, $fio){
        $dateNow = \Carbon\Carbon::Now();
        $course = NULL;
        if($dateNow->year - $zayav->groups->year === 0) {
            $course = 1;
        }
        else $course =  ($dateNow->year - $zayav->groups->year) + 1;

        $phpWord = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('templates/nepolnaya.docx'));

        $phpWord->setValue('number_sprv',$zayav->spravka->id);
        $phpWord->setValue('date_sprv',\Carbon\Carbon::parse($zayav->spravka->date)->format('d.m.Y'));
        $phpWord->setValue('student',$fio[0] . ' '. $fio[1] . ' '. $fio[2]);
        $phpWord->setValue('year',$zayav->year);
        $phpWord->setValue('number_order',$zayav->groups->orders->number);
        $phpWord->setValue('date_order',\Carbon\Carbon::parse($zayav->groups->orders->date)->format('d.m.Y'));
        $phpWord->setValue('course',$course);
        $phpWord->setValue('organization',$zayav->Organization);
        
        $name = $zayav->spravka->id. ' от ' . \Carbon\Carbon::parse($zayav->spravka->date)->format('d.m.Y') . '.doc';
        $phpWord->saveAs(storage_path($name));

        return $name;
    }

    public function createPolnayaSpravka($zayav, $student, $fio){
        $dateNow = \Carbon\Carbon::Now(); // получение текущей даты
        $course = NULL;
        if($dateNow->year - $zayav->groups->year === 0)
            $course = 1;
        else 
            $course =  ($dateNow->year - $zayav->groups->year) + 1;

        $srok_okon = NULL;
        switch($student->groups->specialties->period_obuch){
            case '3 года 10 месяцев' :{
                $srok_okon = ['day'=>'30','month'=>'июня','year'=>\Carbon\Carbon::parse($student->groups->orders->date)->addYear(4)->year];
                break;
            }
            case '3 года 6 месяцев' :{
                $srok_okon = ['day'=>\Carbon\Carbon::parse($student->groups->orders->date)->addYear(4)->Month(2)->daysInMonth,'month'=>'февраля','year'=>\Carbon\Carbon::parse($student->groups->orders->date)->addYear(4)->year];
                break;
            }
            case '2 года 10 месяцев' :{
                $srok_okon = ['day'=>'30','month'=>'июня','year'=>\Carbon\Carbon::parse($student->groups->orders->date)->addYear(2)->year];
                break;
            }
        }

        $phpWord = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('templates/polnaya.docx'));

        $phpWord->setValue('number_sprv',$zayav->spravka->id);
        $phpWord->setValue('date_sprv',\Carbon\Carbon::parse($zayav->spravka->date)->format('d.m.Y'));
        $phpWord->setValue('student',$fio[0] . ' '. $fio[1] . ' '. $fio[2]);
        $phpWord->setValue('year',$zayav->year);
        $phpWord->setValue('year_postup',$zayav->groups->year);
        $phpWord->setValue('number_order',$zayav->groups->orders->number);
        $phpWord->setValue('date_order',\Carbon\Carbon::parse($zayav->groups->orders->date)->format('d.m.Y'));
        $phpWord->setValue('course',$course);
        $phpWord->setValue('specialties',$student->groups->specialties->name);
        $phpWord->setValue('period_obuch',$student->groups->specialties->period_obuch);
        $phpWord->setValue('organization',$zayav->Organization);
        $phpWord->setValue('osn_obuch',mb_strtolower($student->osnova->name.'ной'));
        $phpWord->setValue('srok_day',$srok_okon['day']);
        $phpWord->setValue('srok_month',$srok_okon['month']);
        $phpWord->setValue('srok_year',$srok_okon['year']);
        
        $name = $zayav->spravka->id. ' от ' . \Carbon\Carbon::parse($zayav->spravka->date)->format('d.m.Y') . '.doc';
        $phpWord->saveAs(storage_path($name));

        return $name;
    }

    public function createPFSpravka($zayav, $student, $fio){
        $dateNow = \Carbon\Carbon::Now(); // получение текущей даты
        $course = NULL;
        if($dateNow->year - $zayav->groups->year === 0)
            $course = 1;
        else 
            $course =  ($dateNow->year - $zayav->groups->year) + 1;

        $srok_okon = NULL;
        $srok_nach = ['day'=>'01', 'month'=>'сентября','year'=>\Carbon\Carbon::parse($student->groups->orders->date)->year];
        switch($student->groups->specialties->period_obuch){
            case '3 года 10 месяцев' :{
                $srok_okon = ['day'=>'30','month'=>'июня','year'=>\Carbon\Carbon::parse($student->groups->orders->date)->addYear(4)->year];
                break;
            }
            case '3 года 6 месяцев' :{
                $srok_okon = ['day'=>\Carbon\Carbon::parse($student->groups->orders->date)->addYear(4)->Month(2)->daysInMonth,'month'=>'февраля','year'=>\Carbon\Carbon::parse($student->groups->orders->date)->addYear(4)->year];
                break;
            }
            case '2 года 10 месяцев' :{
                $srok_okon = ['day'=>'30','month'=>'июня','year'=>\Carbon\Carbon::parse($student->groups->orders->date)->addYear(2)->year];
                break;
            }
        }

        $phpWord = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('templates/pf.docx'));

        $phpWord->setValue('number_sprv',$zayav->spravka->id);
        $phpWord->setValue('date_sprv',\Carbon\Carbon::parse($zayav->spravka->date)->format('d.m.Y'));
        $phpWord->setValue('student',$fio[0] . ' '. $fio[1] . ' '. $fio[2]);
        $phpWord->setValue('year',$zayav->year);
        $phpWord->setValue('course',$course);
        $phpWord->setValue('number_order',$zayav->groups->orders->number);
        $phpWord->setValue('date_order',\Carbon\Carbon::parse($zayav->groups->orders->date)->format('d.m.Y'));
        $phpWord->setValue('specialties',$student->groups->specialties->name);
        $phpWord->setValue('osn_obuch',mb_strtolower($student->osnova->name.'ной'));
        $phpWord->setValue('srok_nach_day',$srok_nach['day']);
        $phpWord->setValue('srok_nach_month',$srok_nach['month']);
        $phpWord->setValue('srok_nach_year',$srok_nach['year']);
        $phpWord->setValue('srok_okon_day',$srok_okon['day']);
        $phpWord->setValue('srok_okon_month',$srok_okon['month']);
        $phpWord->setValue('srok_okon_year',$srok_okon['year']);
        
        $name = $zayav->spravka->id. ' от ' . \Carbon\Carbon::parse($zayav->spravka->date)->format('d.m.Y') . '.doc';
        $phpWord->saveAs(storage_path($name));

        return $name;
    }

    public function Create_spravka(Request $request, $id){
        // dd((int)$id);
        $zayav = Journal_zayav::find($id);
        $student = Student::where('familiya', $zayav->familiya)->where('imya', $zayav->imya)->where('otchestvo', $zayav->otchestvo)->where('year', $zayav->year)->where('group_id', $zayav->group_id)->first();
        // dd($student);
        if($student == null)
            return redirect()->back()->withErrors('Такой студент отстутствует в списках');
        else{
            $fio = self::getFIO(['familiya'=>$student->familiya,'imya'=>$student->imya,'otchestvo'=>$student->otchestvo], $request->gender);
            switch($zayav->type_spravka->name) {
                case 'Неполная справка': {
                    $name = self::createNepolnSpravka($zayav, $student, $fio);
                    break;   
                }
                case 'Полная справка': {
                    $name = self::createPolnayaSpravka($zayav, $student, $fio);
                    break;   
                }
                case 'Справка в пенсионный фонд': {
                    $name = self::createPFSpravka($zayav, $student, $fio);
                    break;   
                }
            }
        }
        return response()->download(storage_path($name));
    }

    public function Get_journal(){
        $spravki = journal_spravok::all();
        $_excel = PHPExcel_IOFactory::load(storage_path('templates/journal.xlsx'));

        $_excel->setActiveSheetIndex(1);
        $sheet = $_excel->getActiveSheet();
        $row = 4;

        $style = array(
            'borders'=> array(
                'bottom'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array(
                    '	rgb' => '000000'
                    )
                ),
                'top'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array(
                        'rgb' => '000000'
                    )
                ),
                'left'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array(
                        'rgb' => '000000'
                    )
                ),
                'right'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array(
                        'rgb' => '000000'
                    )
                ),
            )
        );
        foreach ($spravki as $item) {
            $sheet->setCellValue('B'.$row, $item->id)->getStyle('B'.$row)->getFont()->setName('Calibri')->setSize('12'); // номер справки
            $sheet->getRowDimension($row)->setRowHeight(20);
            $sheet->setCellValue('C'.$row, $item->zayavka->identify)->getStyle('C'.$row)->getFont()->setName('Calibri')->setSize('12');// номер заявки
            $sheet->setCellValue('D'.$row, $item->zayavka->familiya.' '.$item->zayavka->imya.' '.$item->zayavka->otchestvo)->getStyle('D'.$row)->getFont()->setName('Calibri')->setSize('12'); // ФИО
            $sheet->setCellValue('E'.$row, ($item->zayavka->groups->year % 100).''. $item->zayavka->groups->specialties->short_name.'-'.$item->zayavka->groups->number)->getStyle('E'.$row)->getFont()->setName('Calibri')->setSize('12'); // Группа
            $sheet->setCellValue('F'.$row, \Carbon\Carbon::parse($item->date)->format('d.m.Y'))->getStyle('F'.$row)->getFont()->setName('Calibri')->setSize('12'); // дата справки
            $sheet->setCellValue('G'.$row, $item->zayavka->type_spravka->name)->getStyle('G'.$row)->getFont()->setName('Calibri')->setSize('12'); // тип справки
            $sheet->setCellValue('H'.$row, $item->zayavka->Organization)->getStyle('H'.$row)->getFont()->setName('Calibri')->setSize('12'); // организация
            
            $sheet->getStyle('B'.$row)->applyFromArray($style);
            $sheet->getStyle('C'.$row)->applyFromArray($style);
            $sheet->getStyle('D'.$row)->applyFromArray($style);
            $sheet->getStyle('E'.$row)->applyFromArray($style);
            $sheet->getStyle('F'.$row)->applyFromArray($style);
            $sheet->getStyle('G'.$row)->applyFromArray($style);
            $sheet->getStyle('H'.$row)->applyFromArray($style);
            
            
            $row++;
        }
        $objWriter = PHPExcel_IOFactory::createWriter($_excel, 'Excel5');
        $name = 'Журнал справок от '.\Carbon\Carbon::now()->format('d.m.Y H:i:s').'.xls';
        $objWriter->save(storage_path($name));
        return response()->download(storage_path($name));
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
            $spravka->save();
        }
        elseif ($status == 'Отклонена'){
            $zayav->comment = $request->report;
            $zayav->status = status_zayav::where('name',$status)->get()->first()->id;
        }
        else
            $zayav->status = status_zayav::where('name',$status)->get()->first()->id;
        $zayav->save();
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
