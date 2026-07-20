<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CsatQuestionaire extends Model
{
    //
    public $table = "csatQuestionaire";
    public $fillable = ["question_description","question_type"];
    public $primaryKey = 'question_id';
    public $timestamps = false;
}
