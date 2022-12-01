<?php

namespace App\Http\Controllers;

use App\Models\bankPertanyaan;
use Illuminate\Http\Request;

class BankPertanyaanController extends Controller
{
    public function indexPertanyaan()
    {
        $Pertanyaans = bankPertanyaan::get();
        return view('user.pertanyaan',  ['Pertanyaans' => $Pertanyaans]);
    }
}
