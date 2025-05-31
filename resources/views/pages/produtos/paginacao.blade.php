@extends('index');

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
        <h1 class="h2">Produtos</h1>        
    </div>
    <div>
        <form action="" method="get">
            <input type="text" name="pesquisar" placeholder="Digite o nome">    
            <button> Pesquisar </button>
            <a href="" type="button" class="btn btn-success float-end">
                Incluir Produto
            </a>
        </form>
        <div class="table-responsive mt-4">
            <table class="table table-striped table-sm">
                <thead>
                    <th>Nome</th>
                    <th>Valor</th>
                    <th>Ações</th>
                </thead>
                <tbody>
                    @foreach ($findProduto as $produto)
                    <tr>
                        <td>{{ $produto->nome }}</td>
                        <td>{{ 'R$' . ' ' . number_format($produto->valor, 2, ',', '.') }}</td>
                        <td>
                            <a href="" class="btn btn-light btn-sm">
                                Editar
                            </a>
                            <a href="" class="btn btn-danger btn-sm">
                                Editar
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
