<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitacion extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','confirmacion', 'protegido', 'asistencia'];
    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
}
