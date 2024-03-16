@extends('adminlte::page')

@section('title', 'Editar Cargo e Função')

@section('content_header')
<h3></h3>
@stop

@section('content')

<div class="row">

    <div class="col-md-12">
        @include('shared.error-message')

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Editar Cargo e Função</h3>
            </div>


            <form action="{{route('offices.update',[$office->id])}}" method="post" >
                @csrf 
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                value="{{$office->name}}" name='name' 
                                id="name" placeholder="Digite um nome" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>


                        <div class="form-group col-md-2">
                            <label for="status">Ativo</label>
                            <select class="js-basic form-control" name="status">
                                <option value="">Selecione</option>
                                <option value="1" @if ($office->status == 1) selected @endif>Sim</option>
                                <option value="0" @if ($office->status == 0) selected @endif>Não</option>
                            </select>
                            @error('status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        @if (auth()->user()->is_admin)
                            <div class="form-group col-md-6">
                                <label for="management_unit_id">Selecione a Unidade Gestora</label>
                                <select class="js-basic form-control" name="management_unit_id">
                                    <option value="">Selecione</option>
                                    @foreach($managementUnits as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                                @error('management_unit_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <a href="{{route('offices.view')}}" type="button" class="btn btn-default">Cancelar</a>
                </div>
            </form>
        </div>


    </div>

</div>

@stop