@extends('adminlte::page')

@section('title', 'Nova Pessoa')

@section('content_header')
<h3></h3>
@stop

@section('content')

<div class="row">

    <div class="col-md-12">
        @include('shared.error-message')
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Nova Pessoa</h3>
            </div>


            <form action="{{route('peoples.store')}}" method="post">
                @csrf
                <div class="card-body">

                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name='name'
                                id="name" placeholder="Digite um nome" value="{{ old('name') }}" required>
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                id="email" placeholder="Digite um email" value="{{ old('email') }}" required>
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-3">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control @error('cpf') is-invalid @enderror" name="cpf"
                                id="cpf" placeholder="Digite o cpf" value="{{ old('cpf') }}" required>
                            @error('cpf')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="phone">Telefone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name='phone'
                                id="phone" placeholder="Digite um nome" value="{{ old('phone') }}" required>
                            @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="rg">Rg</label>
                            <input type="text" class="form-control @error('rg') is-invalid @enderror" name='rg'
                                id="rg" placeholder="Digite um nome" value="{{ old('rg') }}" required>
                            @error('rg')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="matricula">Matricula</label>
                            <input type="text" class="form-control @error('matricula') is-invalid @enderror" name='matricula'
                                id="matricula" placeholder="Digite um nome" value="{{ old('matricula') }}" required>
                            @error('matricula')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="office_id">Selecione o Cargo</label>
                        <select class="js-basic form-control" name="office_id">
                            <option value="">Selecione</option>
                            @foreach($offices as $office)
                                <option value="{{ $office->id }}">{{ $office->name }}</option>
                            @endforeach
                        </select>
                        @error('office_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <a href="{{route('peoples.view')}}" type="button" class="btn btn-default">Cancelar</a>
                </div>
            </form>
        </div>

    </div>

</div>

@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('.js-basic-multiple').select2({
                placeholder: 'Selecione os itens',
                width: '100%'
            });
        });
    </script>
@stop
