@extends('adminlte::page')

@section('title', 'Editar Unidade Gestora')

@section('content_header')
<h3></h3>
@stop

@section('content')

<div class="row">

    <div class="col-md-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Editar Unidade Gestora</h3>
            </div>


            <form action="{{route('management_units.update',[$unit->id])}}" method="post" >
                @csrf 
                @method('PUT')
                <div class="card-body">

                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                            value="{{$unit->name}}" name='name' 
                            id="name" placeholder="Digite um nome" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="cod">Código</label>
                        <input type="text" class="form-control @error('cod') is-invalid @enderror" 
                            value="{{$unit->cod}}" name='cod' id="cod" 
                            placeholder="Digite um código" value="{{ old('cod') }}">
                            @error('cod')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Telefone</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                            value="{{$unit->phone}}" name='phone' id="phone" 
                            placeholder="Digite um telefone" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="cnpj">Cnpj</label>
                        <input type="text" class="form-control @error('cnpj') is-invalid @enderror" 
                            value="{{$unit->cnpj}}"name='cnpj' id="cnpj" 
                            placeholder="Digite um cnpj" value="{{ old('cnpj') }}" required>
                            @error('cnpj')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>

                     <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                            value="{{$unit->email}}"name='email' id="email" 
                            placeholder="Digite um email" value="{{ old('email') }}">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <input type="description" class="form-control @error('description') is-invalid @enderror" 
                            value="{{$unit->description}}" name="description" id="description" placeholder="Digite a descrição">
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <a href="{{route('management_units.view')}}" type="button" class="btn btn-default">Cancelar</a>
                </div>
            </form>
        </div>


    </div>

</div>

@stop