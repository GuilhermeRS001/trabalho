<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'status',
    ];

    // (Opcional) Se quiser ligar cada despesa ao usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
