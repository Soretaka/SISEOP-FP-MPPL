<?php

namespace App\Http\Controllers;

use App\Models\bankPertanyaan;
use App\Models\jenisPertanyaan;
use Illuminate\Http\Request;

class BankPertanyaanController extends Controller
{
    public function indexPertanyaan()
    {
        $Pertanyaans = bankPertanyaan::get();
        $JenisPertanyaans = jenisPertanyaan::get();
        return view('user.pertanyaan',  [
            'Pertanyaans' => $Pertanyaans,
            'JenisPertanyaans' => $JenisPertanyaans
        ]);
    }

    public function savePertanyaan(Request $request)
    {
        $request->validate([
            'Pertanyaan' => 'required',
            'JenisPertanyaan' => 'required'
        ]);
        $bankPertanyaan = bankPertanyaan::create([
            'Pertanyaan' => $request->Pertanyaan,
            'JenisPertanyaan' => $request->JenisPertanyaan,
        ]);
        return redirect()->route('pertanyaan-dashboard')->with(['tambah' => 'Pertanyaaan berhasil ditambahkan']);
    }

    public function deletePertanyaan(Request $request)
    {
        $id = $request->route('id');
        $pertanyaan = bankPertanyaan::findorFail($id);
        $pertanyaan->delete();
        if ($pertanyaan) {
            return redirect()->route('pertanyaan-dashboard')->with(['hapus' => 'Pertanyaan berhasil dihapus']);
        } else {
            return redirect()->route('pertanyaan-dashboard')->with(['hapus' => 'Some problem has occurred, please try again']);
        }
    }
}
