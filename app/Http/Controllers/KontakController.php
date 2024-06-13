<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kontak;

class KontakController extends Controller
{
    public function index()
    {
        $kontak = Kontak::latest()->paginate(100);
        return view('#', compact('kontak'));
    }
}
