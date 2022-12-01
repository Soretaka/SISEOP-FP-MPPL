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
        'skor1',
        'skor2',
        'skor3',
        'skor4',
        'skor5',
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
