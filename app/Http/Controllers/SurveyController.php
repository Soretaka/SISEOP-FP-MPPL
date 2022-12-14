<?php

namespace App\Http\Controllers;

use App\Models\survey;
use App\Models\User;
use App\Models\survey_bank;
use App\Models\bankPertanyaan;
use App\Models\survey_ans;
use App\Models\survey_user;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function indexSurvey()
    {
        if (auth()->user()->jabatan_id == 2) {
            $surveys = survey::where('user_id', auth()->user()->id)->get();
            // dd($surveys);
            return view('user.questioner',  ['surveys' => $surveys, 'past' => false]);
        } else if (auth()->user()->jabatan_id != 1) {
            $survey_users = survey_user::where('user_id', auth()->user()->id)->get();
            $list_kosong = [];
            for ($i = 0; $i < count($survey_users); $i++) {
                if ($survey_users[$i]->skorv + $survey_users[$i]->skori + $survey_users[$i]->skorp + $survey_users[$i]->skors == 0) {
                    array_push($list_kosong, $survey_users[$i]->survey_id);
                }
            }
            // $survey_not_yet = survey::whereNotIn('id', $survey_users)->get();
            $nama_survey = survey::whereIn('id', $list_kosong)->get();
            return view('user.questioner',  ['survey_users' => $nama_survey, 'past' => false]);
        } else {
            return redirect()->route('guest-dashboard');
        }
    }

    public function indexPastSurvey()
    {
        $survey_users = survey_user::where('user_id', auth()->user()->id)->get();
        $list_kosong = [];
        for ($i = 0; $i < count($survey_users); $i++) {
            if ($survey_users[$i]->skorv + $survey_users[$i]->skori + $survey_users[$i]->skorp + $survey_users[$i]->skors != 0) {
                array_push($list_kosong, $survey_users[$i]->survey_id);
            }
        }
        // $survey_not_yet = survey::whereNotIn('id', $survey_users)->get();
        $nama_survey = survey::whereIn('id', $list_kosong)->get();
        return view('user.questioner',  ['survey_users' => $nama_survey, 'past' => true]);
    }
    public function kerjakan_survey(Request $request)
    {
        $id = $request->route('id');
        $survey = survey::findorFail($id);
        $survey_bank = survey_bank::where('survey_id', $id)->get();
        $pertanyaans = bankPertanyaan::whereIn('id', $survey_bank->pluck('pertanyaan_id'))->get();
        return view('user.pengerjaanSurvey', [
            'survey' => $survey, 'pertanyaans' => $pertanyaans
        ]);
    }

    public function lockSurvey(Request $request)
    {
        $id = $request->route('id');
        $survey = survey::findorFail($id);
        $list_pertanyaan = survey_bank::where('survey_id', $id)->pluck('pertanyaan_id');
        // return ($list_pertanyaan == null);
        if ($list_pertanyaan->isEmpty()) {
            return redirect()->route('detail-data-survey', $id)->with('error', 'Survey gagal dikunci, pertanyaan masih kosong');
            // return "ayy";
        }
        $survey->is_locked = 1;
        $survey->save();
        return redirect()->route('survey-dashboard')->with('success', 'Survey berhasil dikunci');
    }
    public function tambah_pertanyaan(Request $request)
    {
        $id = $request->survey_id;
        $survey = survey::findorFail($id);
        $id_pertanyaans = survey_bank::where('survey_id', $id)->pluck('pertanyaan_id');
        $pertanyaans = bankPertanyaan::whereNotIn('id', $id_pertanyaans)->get();
        return view('user.tambahPertanyaanSurvey', [
            'survey' => $survey, 'pertanyaans' => $pertanyaans
        ]);
    }

    public function penjawab_semua(Request $request)
    {
        $id = $request->route('id');
        $survey = survey::findorFail($id);
        $users = survey_ans::where('survey_id', $id)->get();
        for ($i = 0; $i < count($users); $i++) {
            $fullusers = User::findorFail($users[$i]->user_id);
            // return ($fullusers->name);
            $users[$i]->name = $fullusers->name;
        }
        return view('user.lihatJawabanUser', [
            'users' => $users, 'survey' => $survey
        ]);
    }

    public function lihat_penjawab_detail(Request $request)
    {
        $survey_id = $request->route('survey_id');
        $user_id = $request->route('user_id');
        // return $survey_id;
        $survey_ans = survey_ans::where('survey_id', $survey_id)->where('user_id', $user_id)->first();
        $user = User::findorFail($user_id);
        $survey_ans->name = $user->name;
        $survey = survey::findorFail($survey_id);
        $survey_ans->survey_name = $survey->NamaSurvey;
        $survey_ans->jawaban = json_decode($survey_ans->jawaban, true);
        $survey_ans->pertanyaan = json_decode($survey_ans->pertanyaan);
        return view('user.lihatJawabanDetail', [
            'survey_ans' => $survey_ans
        ]);
    }
    public function lihat_penjawab(Request $request)
    {
        $id = $request->route('id');
        $users = survey_user::where('survey_id', $id)->get();
        $surveys = survey::findorFail($id);
        for ($i = 0; $i < count($users); $i++) {
            $fullusers = User::findorFail($users[$i]->user_id);
            // return ($fullusers->name);
            $users[$i]->name = $fullusers->name;
            if ($users[$i]->skorv + $users[$i]->skori + $users[$i]->skorp + $users[$i]->skors == 0) {
                $users[$i]->sudah_isi = "belum mengisi";
            } else {
                $users[$i]->sudah_isi = "sudah mengisi";
            }
        }

        return view('user.lihatPenjawab', [
            'users' => $users,
            'survey' => $surveys
        ]);
    }
    public function detail_nilai(Request $request)
    {
        $survey_id = $request->route('id');
        $user_id = auth()->user()->id;
        $survey_user = survey_user::where('survey_id', $survey_id)->where('user_id', $user_id)->first();
        $survey = survey::findorFail($survey_id);
        return view('user.detailNilai', [
            'survey_user' => $survey_user,
            'survey' => $survey,
        ]);
    }
    public function tambahJawaban(Request $request)
    {
        $request->validate([
            'jawaban' => 'required|array|min:1',
            'jawaban.*' => 'required',
        ]);
        $maks_skorv = 0;
        $maks_skori = 0;
        $maks_skorp = 0;
        $maks_skors = 0;
        $skorv = 0;
        $skori = 0;
        $skorp = 0;
        $skors = 0;
        for ($i = 1; $i <= count($request->jawaban); $i++) {
            if ($request->type[$i] == 'V') {
                $maks_skorv += 5;
                $skorv += $request->jawaban[$i];
            } else if ($request->type[$i] == 'I') {
                $maks_skori += 5;
                $skori += $request->jawaban[$i];
            } else if ($request->type[$i] == 'P') {
                $maks_skorp += 5;
                $skorp += $request->jawaban[$i];
            } else if ($request->type[$i] == 'S') {
                $maks_skors += 5;
                $skors += $request->jawaban[$i];
            }
        }
        $survey_user = survey_user::where('survey_id', $request->survey_id)->where('user_id', $request->user_id)->first();
        $survey_user->update([
            'skorv' => $skorv,
            'skori' => $skori,
            'skorp' => $skorp,
            'skors' => $skors,
            'maks_skorv' => $maks_skorv,
            'maks_skori' => $maks_skori,
            'maks_skorp' => $maks_skorp,
            'maks_skors' => $maks_skors,
        ]);
        $survey_ans = survey_ans::create([
            'survey_id' => $request->survey_id,
            'pertanyaan' => json_encode($request->pertanyaan),
            'user_id' => $request->user_id,
            'jawaban' => json_encode($request->jawaban),
        ]);
        return redirect()->route('user-dashboard')->with('success', 'Jawaban berhasil ditambahkan');
    }

    public function add_penjawab(Request $request)
    {
        $survey_user = survey_user::create([
            'survey_id' => $request->survey_id,
            'user_id' => $request->user_id,
        ]);
        return redirect()->route('detail-data-survey', $request->survey_id)->with('success', 'Penjawab berhasil ditambahkan');
    }

    public function halamanTambahJawaban(Request $request)
    {
        $survey_id = $request->route('id');
        $user_assigned = survey_user::where('survey_id', $survey_id)->pluck('user_id');
        $users = User::where('jabatan_id', 3)->whereNotIn('id', $user_assigned)->get();
        return view('user.tambah_penjawab', ['survey_id' => $survey_id, 'users' => $users]);
    }
    public function add_to_bank(Request $request)
    {
        $id = $request->survey_id;
        $survey_bank = survey_bank::create([
            'survey_id' => $request->survey_id,
            'pertanyaan_id' => $request->pertanyaan_id,
        ]);
        return redirect()->route('detail-data-survey', $request->survey_id)->with('success', 'Pertanyaan berhasil ditambahkan');
    }
    public function tambahPertanyaan(Request $request)
    {
        $id = $request->route('id');
        return redirect()->route('tambah-pertanyaan', ['survey_id' => $id]);
    }

    public function detailSurvey(Request $request)
    {
        $id = $request->route('id');
        $survey = survey::findorFail($id);
        $id_pertanyaans = survey_bank::where('survey_id', $id)->pluck('pertanyaan_id');
        $pertanyaans = bankPertanyaan::whereIn('id', $id_pertanyaans)->get();
        return view('user.detailSurvey', [
            'survey' => $survey, 'pertanyaans' => $pertanyaans
        ]);
    }
    public function addSurvey(Request $request)
    {
        $request->validate([
            'namaSurvey' => 'required',
            'Deskripsi' => 'required',
        ]);
        // dd($request);
        $survey = survey::create([
            'NamaSurvey' => $request->namaSurvey,
            'Deskripsi' => $request->Deskripsi,
            'user_id' => auth()->user()->id,
        ]);
        // dd($survey);
        return redirect()->route('survey-dashboard')->with('success', 'Survey berhasil ditambahkan');
    }
    public function deleteSurvey(Request $request)
    {
        $id = $request->route('id');
        $survey = survey::findorFail($id);
        $survey->delete();
        if ($survey) {
            return redirect()->route('survey-dashboard')->with(['hapus' => 'survey berhasil dihapus']);
        } else {
            return redirect()->route('survey-dashboard')->with(['hapus' => 'Some problem has occurred, please try again']);
        }
    }
    public function deletePertanyaan(Request $request)
    {

        $id = $request->route('pertanyaan_id');
        $survey_id = $request->route('survey_id');
        // $survey_bank = survey_bank::findorFail($id);
        $survey_bank = survey_bank::where('pertanyaan_id', $id)->firstorFail();
        $survey_bank->delete();
        if ($survey_bank) {
            return redirect()->route('detail-data-survey', $survey_id)->with(['hapus' => 'pertanyaan dihapus', 'id' => $survey_id]);
        }
    }
}
