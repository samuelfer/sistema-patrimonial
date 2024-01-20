@extends('adminlte::page')

@section('title', 'Responsável Unidade Gestora')

@section('content_header')
<h3></h3>
@stop

@section('content')

<div class="row">

    <div class="col-md-12">
        @include('shared.error-message')
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Responsável Unidade Gestora</h3>
            </div>


            <form action="{{route('management_units_responsible.store')}}" method="post">
                @csrf
                <div class="card-body">
                  
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="management_unit_id">Selecione a unidade gestora</label>
                            <select class="js-basic form-control" name="management_unit_id">
                                <option value="">Selecione</option>
                                @foreach($managementUnits as $managementUnit)
                                    <option value="{{ $managementUnit->id }}">{{ $managementUnit->name }}</option>
                                @endforeach
                            </select>
                            @error('management_unit_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="form-group col-md-6">
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

                        <div class="form-group col-md-6">
                            <label for="date_start">Data início</label>
                            <input type="date" class="form-control @error('date_start') is-invalid @enderror" 
                                name='date_start' id="data_start" 
                                placeholder="Digite a data de início" value="{{ old('date_start') }}">
                                @error('date_start')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="date_end">Data início</label>
                            <input type="date" class="form-control @error('date_end') is-invalid @enderror" 
                                name='date_end' id="date_end" 
                                placeholder="Digite a data de fim" value="{{ old('date_end') }}">
                                @error('date_end')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>

                    <input type="hidden" name="situation_id" value="1">
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <a href="{{route('management_units_responsible.view')}}" type="button" class="btn btn-default">Cancelar</a>
                </div>
            </form>
        </div>

    </div>

</div>

@stop

@section('js')

@stop
