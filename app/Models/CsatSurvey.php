<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CsatSurvey extends Model
{
    //
    public $table = "csatSurvey";
    public $primaryKey = 'survey_id';
    public $timestamps = false;
    public $fillable = ["client_id","emp_id","survey_response","survey_date","survey_status"];
}
