<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userjabatan extends Model
{
    use HasFactory;
    protected $fillable = [
        'jabatan_id',
    ];
    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function jabatan()
    {
        return $this->hasOne(Jabatan::class);
    }
}
