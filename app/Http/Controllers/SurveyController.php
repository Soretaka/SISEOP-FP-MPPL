<?php

namespace App\Http\Controllers;

use App\Models\survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function indexSurvey()
    {
        $surveys = survey::where('user_id', auth()->user()->id)->get();
        return view('user.questioner',  ['surveys' => $surveys]);
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
