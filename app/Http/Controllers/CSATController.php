<?php

namespace App\Http\Controllers;

use App\Events\GenerateSurvey;
use App\Listeners\SurveyCreation;
use Illuminate\Http\Request;

class CSATController extends Controller
{
    // Every end of the Day CSAT generate Survey
    public function GenerateSurvey(Request $req){

    }
}
