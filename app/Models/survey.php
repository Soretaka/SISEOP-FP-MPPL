<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class survey extends Model
{
    use HasFactory;
    protected $fillable = [
        'NamaSurvey',
        'Deskripsi',
        'user_id'
    ];
    public function survey_user()
    {
        return $this->hasOne(survey_user::class);
    }
}
