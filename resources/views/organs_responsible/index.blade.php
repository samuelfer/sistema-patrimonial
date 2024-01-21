@extends('adminlte::page')

@section('title', 'Responsável Orgão')

@section('content_header')
<h3></h3>
@stop

@section('content')


<div class="row">
    <div class="col-12">
        @include('shared.success-message')
        @include('shared.error-message')
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista de Responsáveis Orgão</h3>
                @can('organ_responsible.create')
                <a href="{{route('organ_responsible.create')}}" class="btn btn-sm btn-success float-right">NOVA PESSOA</a>
                @endcan
            </div>

            <div class="card-body">
                <div id="list" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">

                            <table id="list-departmentResponsibles" class="table table-bordered table-striped dataTable dtr-inline"
                                aria-describedby="list-departmentResponsibles">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>UNIDADE</th>
                                        <th>DATA INÍCIO</th>
                                        <th>DATA FIM</th>
                                        <th>SITUAÇÃO</th>
                                        <th style="width: 20px;">AÇÕES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($organsResponsible as $organResponsible)
                                    <tr>
                                        <td>{{ $organResponsible->id }}</td>
                                        <td>{{ $organResponsible->people->name ?? null }}</td>
                                        <td>{{ $organResponsible->date_start ? $organResponsible->date_start->format('d/m/Y H:i') : '' }}</td>
                                        <td>{{ $organResponsible->date_end ? $organResponsible->date_end->format('d/m/Y H:i') : '' }}</td>
                                        <td>{{ $organResponsible->situation->name ?? null}}</td>
                                        <td style="display: inline-block; width: 110px;">
                                            @can('organ_responsible.update')
                                            <a href="{{route('organ_responsible.edit',[$organResponsible->id])}}"
                                                class="btn btn-sm btn-success float-left">Editar</a>
                                            @endcan
                                            @can('organ_responsible.destroy')
                                            <form action="{{route('organ_responsible.destroy', $organResponsible->id)}}" method="post"
                                                class="delete-departmentResponsible">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                            </form>
                                            @endcan
                                        </td>
                                    </tr>

                                    @empty
                                    <tr>
                                        <td colspan="5"> Ainda não há registro cadastrado.</td>
                                    </tr>
                                    @endforelse


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    @stop


    @section('js')

    @if(session('successDel'))
    <script>
    Swal.fire({
        title: "Excluído!",
        text: <?= session('successDel')  ?>,
        icon: "success"
    });
    </script>
    @endif

    @if(session('errorDel'))
    <script>
    Swal.fire({
        title: "Atenção!",
        text: '<?= session('errorDel')  ?>',
        icon: "warning"
    });
    </script>
    @endif

    <script>
    $(function() {

        $("#list-departmentResponsible").DataTable({
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

    $('.delete-departmentResponsible').submit(function(ev) {
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
