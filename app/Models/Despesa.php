<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Despesa extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'descricao',
        'valor_total',
        'parcelas',
        'parcelas_pagas',
        'data_vencimento',
        'categoria',
        'em_aberto'
    ];
}
