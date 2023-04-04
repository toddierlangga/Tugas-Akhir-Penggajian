<?php

namespace App\Models\Personalia;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;

    protected $table = 'divisi';

    protected $primaryKey = 'id_divisi';
    
    public $timestamps = false;

    protected $fillable = [
        'nama_divisi',
    ];
}
