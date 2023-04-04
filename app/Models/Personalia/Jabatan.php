<?php

namespace App\Models\Personalia;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatan';

    protected $primaryKey = 'id_jabatan';
    
    public $timestamps = false;

    protected $fillable = [
        'nama_jabatan',
    ];
}
