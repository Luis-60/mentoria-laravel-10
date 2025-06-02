<?php

namespace Database\Seeders;
use App\Models\Cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cliente::create(
         [
            'nome' => 'luis',
            'email' => 'luis@aedb.br',
            'endereco' => 'endereco',
            'logradouro' => 'logradouro',
            'cep' => 'cep',
            'bairro' => 'bairro',
         ]

         );
    }
}
