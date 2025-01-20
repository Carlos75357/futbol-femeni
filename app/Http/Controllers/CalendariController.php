<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partit;

class CalendariController extends Controller
{
    public function index() {
        $partits = Partit::groupBy('jornada');
        $partits = Partit::paginate(9);
        // dd($partits);
        return view('calendaris.index', compact('partits'));
    }
}
