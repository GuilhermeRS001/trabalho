<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Despesa;

class DespesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $usuario = User::create([
            'name' => 'teste',
            'email' => 'teste@teste.com',
            'password' => bcrypt('123456789')
        ]);

        Despesa::create([
            'user_id' => $usuario->id,
            'descricao' => 'luz',
            'valor_total' => 150.00,
            'parcelas' => 10,
            'parcelas_pagas' => 9,
            'data_vencimento' => now()->format('Y-m-10'),
            'categoria' => 'luz',
            'em_aberto' => true,
            'mes_referencia' => now()->format('Y-m')
        ]);

        Despesa::create([
            'user_id' => $usuario->id,
            'descricao' => 'carro',
            'valor_total' => 16800.00,
            'parcelas' => 48,
            'parcelas_pagas' => 20,
            'data_vencimento' => now()->format('Y-m-10'),
            'categoria' => 'transporte',
            'em_aberto' => true,
            'mes_referencia' => now()->format('Y-m')
        ]);

        Despesa::create([
            'user_id' => $usuario->id,
            'descricao' => 'Mercado',
            'valor_total' => 500.00,
            'parcelas' => 1,
            'parcelas_pagas' => 0,
            'data_vencimento' => now()->format('Y-m-10'),
            'categoria' => 'mercado',
            'em_aberto' => true,
            'mes_referencia' => now()->format('Y-m')
        ]);
           
        Despesa::create([
            'user_id' => $usuario->id,
            'descricao' => 'Camiseta',
            'valor_total' => 105.00,
            'parcelas' => 2,
            'parcelas_pagas' => 2,
            'data_vencimento' => now()->format('Y-m-10'),
            'categoria' => 'cartao de credito',
            'em_aberto' => false,
            'mes_referencia' => now()->format('Y-m')
        ]);
        
        Despesa::create([
            'user_id' => $usuario->id,
            'descricao' => 'Água',
            'valor_total' => 150.00,
            'parcelas' => 1,
            'parcelas_pagas' => 0,
            'data_vencimento' => now()->format('Y-m-10'),
            'categoria' => 'Água',
            'em_aberto' => true,
            'mes_referencia' => now()->format('Y-m')
        ]);

        Despesa::create([
            'user_id' => $usuario->id,
            'descricao' => 'Internet',
            'valor_total' => 150.00,
            'parcelas' => 1,
            'parcelas_pagas' => 1,
            'data_vencimento' => now()->format('Y-m-10'),
            'categoria' => 'internet',
            'em_aberto' => false,
            'mes_referencia' => now()->format('Y-m')
        ]);

        Despesa::create([
            'user_id' => $usuario->id,
            'descricao' => 'tenis',
            'valor_total' => 300.00,
            'parcelas' => 5,
            'parcelas_pagas' => 0,
            'data_vencimento' => now()->format('Y-m-10'),
            'categoria' => 'cartao de credito',
            'em_aberto' => true,
            'mes_referencia' => now()->format('Y-m')
        ]);




    }
}
