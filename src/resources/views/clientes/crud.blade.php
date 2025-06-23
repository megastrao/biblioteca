@extends('adminlte::page')

@section('title', 'Cadastro de Clientes')

@section('content_header')


@stop

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cadastro de Cliente</h3>
        </div>
        <div class="card-body">
            <div class=" form-group">

                @if (isset($clint->id))
                    <form method="post" action="{{ route('cliente.update', ['cliente' => $clint->id]) }}">
                        @csrf
                        @method('PUT')
                    @else
                        <form method="post" action="{{ route('cliente.store') }}">
                            @csrf
                @endif

                <label for="nome">Cliente</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder=""
                    value="{{ $clint->nome ?? old('nome') }}">
                @if ($errors->has('nome'))
                    <span style="color: red;">
                        {{ $errors->first('nome') }}
                    </span>
                @endif
                <br>
                
                <label for="cpf">CPF</label>
                <input type="text" class="form-control" id="cpf" name="cpf" placeholder=""
                    value="{{ $clint->cpf ?? old('cpf') }}">
                @if ($errors->has('cpf'))
                    <span style="color: red;">
                        {{ $errors->first('cpf') }}
                    </span>
                @endif
                <br>
                
                <label for="cep">CEP</label>
                <input type="text" class="form-control" id="cep" name="cep" placeholder=""
                    value="{{ $clint->cep ?? old('cep') }}">
                @if ($errors->has('cep'))
                    <span style="color: red;">
                        {{ $errors->first('cep') }}
                    </span>
                @endif
                <br>
                
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder=""
                    value="{{ $clint->email ?? old('email') }}">
                @if ($errors->has('email'))
                    <span style="color: red;">
                        {{ $errors->first('email') }}
                    </span>
                @endif
                <br>

            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Registrar</button>
            <a href="{{ route('cliente.index') }}" type="button" class="btn btn-secondary">Voltar</a>
        </div>
        </form>

    </div>
@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('js')
    <script src="{{ asset('vendor/jquery/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/jquery.maskMoney.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        f

        $(document).ready(function() {

            

        });
    </script>
@stop