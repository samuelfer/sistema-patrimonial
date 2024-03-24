@extends('adminlte::page')

@section('title', 'Lista de Cargos e Função')

@section('content_header')
<h3></h3>
@stop

@section('content')


<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">Filtros</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>

    <div class="card-body">
        <form action="{{ route('offices.view') }}">
            <div class="row">

                <div class="form-group col-md-4 col-sm-12">
                    <label class="form-label" for="name">Nome</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $name }}"
                        placeholder="Nome" />
                </div>

                <div class="form-group col-md-3 col-sm-12">
                    <label>Data Início</label>
                    <div class="input-group date" id="start_date" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#start_date">
                        <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker"  value="{{ $startDate }}">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-3 col-sm-12">
                    <label>Data Fim</label>
                    <div class="input-group date" id="end_date">
                        <input type="text" class="form-control datetimepicker-input" data-target="#end_date">
                        <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker"  value="{{ $endDate }}">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2 col-sm-12 mt-3 pt-4">
                    <button type="submit" class="btn btn-info btn-sm">Pesquisar</button>
                    <a href="{{ route('offices.view') }}" class="btn btn-warning btn-sm">Limpar</a>
                </div>

            </div>

        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        @include('shared.success-message')
        @include('shared.error-message')
        <h3 class="card-title">Listagem de Cargos e Funções</h3>
        @can('offices.create')
        <a href="{{ url('cargos/gerar-pdf?' . request()->getQueryString()) }}"
            class="btn btn-sm btn-warning float-right ml-2">Gerar PDF</a>
        <a href="{{route('offices.create')}}" class="btn btn-sm btn-success float-right">NOVO CARGO E FUNÇÃO</a>
        @endcan
    </div>


    <div class="card-body">

        <div id="list" class="dataTables_wrapper dt-bootstrap4 border-light shadow">

            <div class="row">
                <div class="col-sm-12">
                    <table id="list-offices" class="table table-bordered table-striped dataTable dtr-inline "
                        aria-describedby="list-offices">
                        <thead>
                            <th>ID</th>
                            <th>NOME</th>
                            <th>ATIVO</th>
                            <th style="width: 20px;">AÇÕES</th>
                        </thead>
                        <tbody>

                            @forelse($offices as $office)
                            <tr>
                                <td>{{ $office->id}}</td>
                                <td>{{ $office->name}}</td>
                                <td>{{ $office->status == 1 ? 'Sim' : 'Não' }}</td>
                                <td style="display: inline-block; width: 110px;">
                                    @can('offices.update')
                                    <a href="{{route('offices.edit',[$office->id])}}"
                                        class="btn btn-sm btn-success float-left">Editar
                                    </a>
                                    @endcan
                                    @can('offices.destroy')
                                    <form action="{{route('offices.destroy', $office->id)}}" method="post"
                                        class="delete-offices">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>

                            @empty
                            <tr>
                                <td colspan="5">Nenhum registro encontrado.</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

</div>


@stop

@section('js')


<script>

$(function() {

    $('#start_date').datetimepicker({
        format: 'DD-MM-YYYY',
        language: 'pt-br'
    });
    

    $('#end_date').datetimepicker({
        format: 'DD-MM-YYYY',
    });

    $("#list-offices").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "search": "Pesquisar",
        "paginate": {
            "next": "Próximo",
            "previous": "Anterior",
            "first": "Primeiro",
            "last": "Último"
        },
        "language": {
            "url": '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json',
        },
    });
});

$('.delete-offices').submit(function(ev) {
    ev.preventDefault();

    Swal.fire({
        title: "Tem certeza que deseja excluir?",
        text: "O registro será excluído!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sim, excluir!"
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });
});
</script>

@stop