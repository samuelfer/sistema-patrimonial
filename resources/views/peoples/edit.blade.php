@extends('adminlte::page')

@section('title', 'Editar Pessoa')

@section('content_header')
<h3></h3>
@stop

@section('content')

<div class="row">

    <div class="col-md-12">
        @include('shared.error-message')
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Editar dados da Pessoa</h3>
            </div>


            <form action="{{route('peoples.update', $people->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="card-body">

                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name='name'
                                id="name" placeholder="Digite um nome" value="{{  $people->name }}" required>
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                id="email" placeholder="Digite um email" value="{{  $people->email }}" required>
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-3">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control @error('cpf') is-invalid @enderror" name="cpf"
                                id="cpf" placeholder="Digite o cpf" value="{{  $people->cpf }}" required>
                            @error('cpf')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="phone">Telefone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name='phone'
                                id="phone" placeholder="Digite um telefone" value="{{  $people->phone }}">
                            @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="rg">Rg</label>
                            <input type="text" class="form-control @error('rg') is-invalid @enderror" name='rg'
                                id="rg" placeholder="Digite um Rg" value="{{$people->rg }}">
                            @error('rg')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="matricula">Matricula</label>
                            <input type="text" class="form-control @error('matricula') is-invalid @enderror" name='matricula'
                                id="matricula" placeholder="Digite uma matrícula" value="{{ $people->matricula }}" >
                            @error('matricula')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-8">
                            <label for="office_id">Selecione o Cargo</label>
                            <select class="js-basic form-control" name="office_id">
                                <option value="">Selecione</option>
                                @foreach($offices as $office)
                                    <option  @if ($office->id == $people->office_id) selected @endif value="{{ $office->id }}">{{ $office->name }}</option>
                                @endforeach
                            </select>
                            @error('office_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="status">Status</label>
                            <select class="js-basic form-control" name="status">
                                <option value="">Selecione</option>
                                <option value="1" @if ($people->status == 1) selected @endif>Ativo</option>
                                <option value="0" @if ($people->status == 0) selected @endif>Inativo</option>
                            </select>
                            @error('status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
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
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#phone').inputmask('(99)-999-9999');
            $('#cpf').inputmask('999.999.999-99');
        });
    </script>
@stop