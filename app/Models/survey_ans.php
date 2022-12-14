<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class survey_ans extends Model
{
    use HasFactory;
    protected $fillable = [
        'survey_id',
        'user_id',
        'pertanyaan',
        'jawaban',
    ];
    protected $cast = [
        'pertanyaan' => 'array',
        'jawaban' => 'array'
    ];
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
