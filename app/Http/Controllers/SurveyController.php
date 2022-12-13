<?php

namespace App\Http\Controllers;

use App\Models\survey;
use App\Models\survey_user;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function indexSurvey()
    {
        if (auth()->user()->jabatan_id == 2) {
            $surveys = survey::where('user_id', auth()->user()->id)->get();
            // dd($surveys);
            return view('user.questioner',  ['surveys' => $surveys]);
        } else if (auth()->user()->jabatan_id != 1) {
            $survey_users = survey_user::where('user_id', auth()->user()->id)->pluck('survey_id');

            $nama_survey = survey::whereIn('id', $survey_users)->get();
            return view('user.questioner',  ['survey_users' => $nama_survey]);
        } else {
            return redirect()->route('guest-dashboard');
        }
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
        return redirect()->route('survey-dashboard');
    }
}
