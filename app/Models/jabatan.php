<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jabatan extends Model
{
    use HasFactory;
    protected $fillable = [
        'NamaJabatan',
    ];
    public function user_jabatan()
    {
        return $this->hasOne(user_jabatan::class);
    }
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
