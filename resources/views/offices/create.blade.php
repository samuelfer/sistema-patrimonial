@extends('adminlte::page')

@section('title', 'Novo Cargo e Função')

@section('content_header')
<h3></h3>
@stop

@section('content')

<div class="row">

    <div class="col-md-12">
        @include('shared.error-message')
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Novo Cargo e Função</h3>
            </div>

            <form action="{{route('offices.store')}}" method="post" >
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