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
        return view('index');
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
    
}
