@extends('adminlte::page')

@section('title', 'Responsável Departamento')

@section('content_header')
<h3></h3>
@stop

@section('content')

<div class="row">

    <div class="col-md-12">
        @include('shared.error-message')
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Responsável departamento</h3>
            </div>


            <form action="{{route('departmentsResponsibles.store')}}" method="post">
                @csrf
                <div class="card-body">
                  
                    <div class="form-group">
                        <label for="office_id">Selecione o Departamento</label>
                        <select class="js-basic form-control" name="department_id">
                            <option value="">Selecione</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="management_id">Selecione a Gestão</label>
                        <select class="js-basic form-control" name="management_id">
                            <option value="">Selecione</option>
                            @foreach($managements as $management)
                                <option value="{{ $management->id }}">{{ $management->start }}</option>
                            @endforeach
                        </select>
                        @error('management_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="people_id">Selecione o Responsável</label>
                        <select class="js-basic form-control" name="people_id">
                            <option value="">Selecione</option>
                            @foreach($responsibles as $responsible)
                                <option value="{{ $responsible->id }}">{{ $responsible->name }}</option>
                            @endforeach
                        </select>
                        @error('people_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <a href="{{route('departmentsResponsibles.view')}}" type="button" class="btn btn-default">Cancelar</a>
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
