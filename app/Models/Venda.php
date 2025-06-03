<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produto;
use App\Models\Cliente;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_da_venda',
        'produto_id',
        'cliente_id',
    ];

    public function produto() 
    {
        return $this->belongsTo(Produto::class); 
    }
    public function cliente() 
    {
        return $this->belongsTo(Cliente::class); 
    }

    public function getVendasPesquisarIndex(string $search = '')
    {
        $venda = $this->where(function($query) use ($search){
            if ($search) {
                $query->where('numero_da_venda', $search);
                $query->orWhere('numero_da_venda', 'LIKE', '%{$search}%');
            }
        })->get();
        return $venda;
    }
}
