@extends('adminlte::page')

@section('title', 'Nova Gestão')

@section('content_header')
<h3></h3>
@stop

@section('content')

<div class="row">

    <div class="col-md-12">
        @include('shared.error-message')
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Nova Gestão</h3>
            </div>

            <form action="{{route('managements.store')}}" method="post" >
                @csrf 
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="start">Início</label>
                            <input type="text" class="form-control data @error('start') is-invalid @enderror" name='start' id="start" 
                                placeholder="Início da gestão" value="{{ old('start') }}" required>
                                @error('start')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="form-group col-md-3">
                            <label for="end">Fim</label>
                            <input type="text" class="form-control data @error('end') is-invalid @enderror" name='end' id="end" 
                                placeholder="Fim da gestão" value="{{ old('end') }}" required>
                                @error('end')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <input type="hidden" name="status" value="1">

                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <a href="{{route('managements.view')}}" type="button" class="btn btn-default">Cancelar</a>
                </div>
            </form>
        </div>


    </div>

</div>

@stop

@section('js')
@section('plugins.DateRangePicker', true)
    <script>
        $(function () {
            const agora = moment(new Date());
            $('input[name="start"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 2020,
                maxYear: parseInt(moment().add(10, "y").format('YYYY'),10),
                locale: {
                    format: 'DD/MM/YYYY',
                }
            });
                
            $('input[name="end"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 2020,
                maxYear: parseInt(moment().add(20, "y").format('YYYY'),10),
                locale: {
                    format: 'DD/MM/YYYY',
                }
            });
        });
       
      
        </script>
    
@stop        