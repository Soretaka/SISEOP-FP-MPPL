<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class survey_user extends Model
{
    use HasFactory;
    protected $fillable = [
        'survey_id',
        'user_id',
        'skorv',
        'skori',
        'skorp',
        'skors',
        'maks_skorv',
        'maks_skori',
        'maks_skorp',
        'maks_skors',
    ];
    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function survey()
    {
        return $this->hasMany(survey::class);
    }
}
