@extends('index')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
        <h1 class="h2">Criar novo Produto</h1>        
    </div>
    <form class="form" method="POST" action="{{ route('cadastrar.produto') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" value="{{ @old('nome')}}" class="form-control @error('nome') is-invalid @enderror"  name="nome">
            @if ($errors->has('nome'))
                <div class="invalid-feedback"> {{ $errors->first('nome')}}</div>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Valor</label>
            <input id='mascara_valor' value="{{ @old('value')}}" class="form-control @error('valor') is-invalid @enderror" name="valor"> 
            @if ($errors->has('valor'))
                <div class="invalid-feedback">{{ $errors->first('valor')}}</div>
            @endif
        </div>
        <button type="submit" class="btn btn-success">CADASTRAR</button>
    </form>


@endsection