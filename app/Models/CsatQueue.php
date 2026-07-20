<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CsatQueue extends Model
{
    //
    public $table = "csatQueue";
    public $fillable = ["client_id","emp_id"];
    public $timestamps = false;
    public $primaryKey = "queue_id";
}
