@extends('adminlte::page')

@section('title', 'Nova Unidade Gestora')

@section('content_header')
<h3></h3>
@stop

@section('content')

<div class="row">

    <div class="col-md-12">
        @include('shared.error-message')
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Nova Unidade Gestora</h3>
            </div>

            <form action="{{route('management_units.store')}}" method="post" >
                @csrf 
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name='name' id="name" 
                                placeholder="Digite um nome" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="form-group col-md-3">
                            <label for="cod">Código</label>
                            <input type="text" class="form-control @error('cod') is-invalid @enderror" name='cod' id="cod" 
                                placeholder="Digite um código" value="{{ old('cod') }}">
                                @error('cod')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="phone">Telefone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name='phone' id="phone" 
                                placeholder="Digite um telefone" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="cnpj">Cnpj</label>
                            <input type="text" class="form-control @error('cnpj') is-invalid @enderror" name='cnpj' id="cnpj" 
                                placeholder="Digite um cnpj" value="{{ old('cnpj') }}">
                                @error('cnpj')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name='email' id="email" 
                                placeholder="Digite um email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>
                  
                        <div class="form-group col-md-5">
                            <label for="people_id">Selecione o responsável</label>
                            <select class="js-basic form-control" name="people_id">
                                <option value="">Selecione</option>
                                @foreach($peoples as $people)
                                    <option value="{{ $people->id }}">{{ $people->name }}</option>
                                @endforeach
                            </select>
                            @error('people_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">

                        <div class="form-group col-md-12">
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
                    <a href="{{route('management_units.view')}}" type="button" class="btn btn-default">Cancelar</a>
                </div>
            </form>
        </div>


    </div>

</div>

@stop
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#phone').inputmask('(99)-9999-9999');
            $('#cnpj').inputmask('99.999.999/999-99');
        });
    </script>
@stop