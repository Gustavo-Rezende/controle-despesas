<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartao extends Model
{
    use HasFactory;

    protected $table = 'cartao';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_user',
        'saldo',
        'numero_cartao'
    ];
}
