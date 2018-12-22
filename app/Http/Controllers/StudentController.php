<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\student_osnova;
use App\student_status;
use App\Group;

class StudentController extends Controller
{
    public function Index() {
        $students = Student::all();
        return view('home.students.index', compact('students'));
    }

    public function FindStudent(Request $reqest) {
        $students = Student::where('familiya', 'like','%'. $reqest->search .'%')->
                                orWhere('imya', 'like','%'. $reqest->search .'%')->
                                orWhere('otchestvo', 'like','%'. $reqest->search .'%')->
                                orWhere('year', 'like','%'. $reqest->search .'%')->get();
        return view('home.students.index', compact('students'));
    }

    public function NewStudent() {
        $osn = student_osnova::all();
        $status = student_status::all();
        $groups = Group::all();
        return view('home.students.new',compact('osn','status','groups'));
    }
    
    public function AddNewStudent(Request $request) {
        $student = new Student();

        $request->validate([
            'familiya'=>'required',
            'imya'=>'required',
            'otchestvo'=>'required',
            'year'=>'required|integer',
            'group'=>'required',
            'osn_obuch'=>'required',
            'status'=>'required'
        ]);

        $student->familiya = $request->familiya;
        $student->imya = $request->imya;
        $student->otchestvo = $request->otchestvo;
        $student->year = $request->year;
        $student->group_id = $request->group;
        $student->osn_obuch = $request->osn_obuch;
        $student->status = $request->status;

        $student->save();

        return redirect()->back()->with('success', 'Студент успешно добавлен!');
    }

    public function EditStudent($id) {
        $student = Student::find($id);
        $osnova = student_osnova::all();
        $status = student_status::all();
        $group = Group::all();
        return view('home.students.edit', compact('student', 'osnova', 'status', 'group'));
    }

    public function ApplyEditStudent(Request $request, $id) {
        $fio = explode(' ',trim($request->fio));
        $student = Student::find($id);
        $student->familiya = $fio[0];
        $student->imya = $fio[1];
        $student->otchestvo = $fio[2];
        $student->year = $request->year;
        $student->group_id = $request->group;
        $student->osn_obuch = $request->osnova;
        $student->status = $request->status;

        $student->save();
        return redirect()->back()->with('success', 'Студент успешно изменен!');
    }

    public function Delete($id) {
        $student = Student::find($id);

        $student->delete();

        return redirect()->back()->with('success', 'Студент спешно удален!');
    }
}
