@extends('adminlte::page')

@section('title', 'Editar Responsável do Setor')

@section('content_header')
<h3></h3>
@stop

@section('content')

<div class="row">

    <div class="col-md-12">
        @include('shared.error-message')
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Editar Responsável do Setor</h3>
            </div>


            <form action="{{route('sector_responsible.update', $sectorResponsible->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="sector_id">Selecione o Setor</label>
                            <select class="js-basic form-control" name="sector_id">
                                <option value="">Selecione</option>
                                @foreach($sectors as $sector)
                                    <option @if ($sector->id == $sectorResponsible->sector_id) selected @endif value="{{ $sector->id }}">{{ $sector->name }}</option>
                                @endforeach
                            </select>
                            @error('sector_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="people_id">Selecione o responsável</label>
                            <select class="js-basic form-control" name="people_id">
                                <option value="">Selecione</option>
                                @foreach($peoples as $people)
                                    <option @if ($people->id == $sectorResponsible->people_id) selected @endif  value="{{ $people->id }}">{{ $people->name }}</option>
                                @endforeach
                            </select>
                            @error('people_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="situation_id">Selecione a situação</label>
                            <select class="js-basic form-control" name="situation_id">
                                <option value="">Selecione</option>
                                @foreach($situations as $situation)
                                    <option @if ($situation->id == $sectorResponsible->people_id) selected @endif
                                        value="{{ $situation->id }}">{{ $situation->name }}</option>
                                @endforeach
                            </select>
                            @error('situation_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="date_start">Data início</label>
                            <input type="date" class="form-control @error('date_start') is-invalid @enderror"
                                   name="date_start" id="date_start" value="{{ $sectorResponsible->date_start ?? now()->format('Y-m-d') }}"
                                   placeholder="Digite a data de início">
                            @error('date_start')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="date_end">Data fim</label>
                            <input type="date" class="form-control @error('date_end') is-invalid @enderror"
                                   name="date_end" id="date_end" value="{{ $sectorResponsible->date_end ?? now()->format('Y-m-d') }}"
                                   placeholder="Digite a data de fim">
                            @error('date_end')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <a href="{{route('sector_responsible.view')}}" type="button" class="btn btn-default">Cancelar</a>
                </div>
            </form>
        </div>

    </div>

</div>

@stop

@section('js')

@stop
