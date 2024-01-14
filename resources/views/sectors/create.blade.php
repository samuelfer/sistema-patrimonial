@extends('adminlte::page')

@section('title', 'Novo Setor')

@section('content_header')
<h3></h3>
@stop

@section('content')

<div class="row">

    <div class="col-md-12">
        @include('shared.error-message')
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Novo Setor</h3>
            </div>

            <form action="{{route('sectors.store')}}" method="post" >
                @csrf
                <div class="card-body">

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name='name' id="name"
                                placeholder="Digite um nome" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="form-group col-md-2">
                            <label for="cod">Sigla</label>
                            <input type="text" class="form-control @error('sigla') is-invalid @enderror" name='sigla' id="sigla"
                                placeholder="Digite uma sigla" value="{{ old('sigla') }}">
                                @error('sigla')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="organ_id">Órgão</label>
                            <select class="js-basic form-control" name="organ_id">
                                <option value="">Selecione</option>
                                @foreach($organs as $organ)
                                    <option value="{{ $organ->id }}">{{ $organ->name }}</option>
                                @endforeach
                            </select>
                            @error('organ_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="phone">Telefone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                 name='phone' id="phone"
                                placeholder="Digite um telefone" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                name='email' id="email"
                                placeholder="Digite um email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <input type="text" class="form-control @error('descricao') is-invalid @enderror"
                            name="descricao" id="descricao" placeholder="Digite a descrição" value="{{ old('descricao') }}">
                            @error('descricao')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <a href="{{route('sectors.view')}}" type="button" class="btn btn-default">Cancelar</a>
                </div>
            </form>
        </div>


    </div>

</div>

@stop
