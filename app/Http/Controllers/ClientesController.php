<?php

namespace App\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use App\Models\Cliente;
use App\Models\Componentes;

use Illuminate\Http\Request;
use App\Http\Requests\FormRequestClientes;

class ClientesController extends Controller
{
    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;

    }

    public function index (Request $request) 
    {
        $pesquisar = $request->pesquisar;
        $findCliente = $this->cliente->getclientesPesquisarIndex(search: $pesquisar ?? '');
        return view('pages.clientes.paginacao', compact('findCliente'));
    }
    public function delete(Request $request)
    {   
        $id = $request->id;
        $buscaRegistro = Cliente::find($id);
        $buscaRegistro->delete();
        return response()->json(['success'=> true]);
    }

    public function cadastrarCliente(FormRequestClientes $request)
    {
        if($request->method() == "POST"){
            $data = $request->all();
            $componentes = new Componentes();
            Cliente::create($data);

            Toastr::success('Gravado com sucesso');

            return redirect()->route('clientes.index');
        }
        return view('pages.clientes.create');
    }

    public function atualizarCliente(FormRequestClientes $request, $id)
    {
        if($request->method() == "PUT"){
            $data = $request->all();
            $componentes = new Componentes();
            
            $buscaRegistro = Cliente::find($id);
            $buscaRegistro->update($data);

            return redirect()->route('cliente.index');
        }

        $findcliente = Cliente::where('id', '=', $id)->first();
        return view('pages.clientes.atualiza', compact('findCliente'));
    }
    
    
}
