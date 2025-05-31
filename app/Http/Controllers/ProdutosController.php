<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Componentes;

use App\Http\Requests\FormRequestProduto;
class ProdutosController extends Controller
{
    public function __construct(Produto $produto)
    {
        $this->produto = $produto;

    }

    public function index (Request $request) 
    {
        $pesquisar = $request->pesquisar;
        $findProduto = $this->produto->getProdutosPesquisarIndex(search: $pesquisar ?? '');
        return view('pages.produtos.paginacao', compact('findProduto'));
    }
    public function delete(Request $request)
    {   
        $id = $request->id;
        $buscaRegistro = Produto::find($id);
        $buscaRegistro->delete();
        return response()->json(['success'=> true]);
    }

    public function cadastrarProduto(FormRequestProduto $request)
    {
        if($request->method() == "POST"){
            $data = $request->all();
            $componentes = new Componentes();
            $data['valor'] = $componentes->formatacaoMascaraDinheiroDecimal($data['valor']);
            Produto::create($data);

            return redirect()->route('produto.index');
        }
        return view('pages.produtos.create');
    }

    public function atualizarProduto(FormRequestProduto $request, $id)
    {
        if($request->method() == "PUT"){
            $data = $request->all();
            $componentes = new Componentes();
            $data['valor'] = $componentes->formatacaoMascaraDinheiroDecimal($data['valor']);
            
            $buscaRegistro = Produto::find($id);
            $buscaRegistro->update($data);

            return redirect()->route('produto.index');
        }

        $findProduto = Produto::where('id', '=', $id)->first();
        return view('pages.produtos.atualiza', compact('findProduto'));
    }
}
