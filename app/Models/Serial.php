<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serial extends Model
{
    //Da nome a tabela que o laravel vai gravar, pro default ele colocaria serials
    protected $table = 'serial_onu';

    use HasFactory;
    protected $fillable = [
        'tipo_onu_estoque',
        'serial_estoque',
        'motivo_entrega',
        'desc_estoque',
        'complement',
        'nome_responsavel',
        'user',
    ];
}
