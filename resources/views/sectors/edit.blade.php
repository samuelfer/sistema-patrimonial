@extends('adminlte::page')

@section('title', 'Editar Setor')

@section('content_header')
<h3></h3>
@stop

@section('content')

<div class="row">

    <div class="col-md-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Editar Setor</h3>
            </div>


            <form action="{{route('sectors.update',[$sector->id])}}" method="post" >
                @csrf 
                @method('PUT')
                <div class="card-body">

                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                            value="{{$sector->name}}" name='name' 
                            id="name" placeholder="Digite um nome" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="sigla">Sigla</label>
                        <input type="text" class="form-control @error('sigla') is-invalid @enderror" 
                            value="{{$sector->sigla}}" name='sigla' id="sigla" 
                            placeholder="Digite uma sigla" value="{{ old('sigla') }}">
                            @error('sigla')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="organ_id">Selecione órgão</label>
                        <select class="js-basic form-control" name="organ_id">
                            <option value="">Selecione</option>
                                @foreach($organs as $organ)
                                    <option @if ($organ->id == $sector->organ_id) selected @endif
                                     value="{{ $organ->id }}">{{ $organ->name }}</option>
                                @endforeach
                        </select>
                        @error('organ_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <input type="description" class="form-control @error('description') is-invalid @enderror" 
                            value="{{$sector->description}}" name="description" id="description" placeholder="Digite a descrição">
                            @error('description')
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