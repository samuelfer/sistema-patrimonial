@extends('adminlte::page')

@section('title', 'Responsável Setor')

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
                <h3 class="card-title">Lista de Responsáveis de Setor</h3>
                @can('sector_responsible.create')
                <a href="{{route('sector_responsible.create')}}" class="btn btn-sm btn-success float-right">NOVO RESPONSÁVEL</a>
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
                                        <th>SETOR</th>
                                        <th>RESPONSÁVEL</th>
                                        <th>DATA INÍCIO</th>
                                        <th>DATA FIM</th>
                                        <th>SITUAÇÃO</th>
                                        <th style="width: 20px;">AÇÕES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($sectorsResponsibles as $sectorResponsible)
                                    <tr>
                                        <td>{{ $sectorResponsible->id }}</td>
                                        <td>{{ $sectorResponsible->sector->name}}</td>
                                        <td>{{ $sectorResponsible->people->name ?? null }}</td>
                                        <td>{{ $sectorResponsible->date_start ? $sectorResponsible->date_start->format('d/m/Y H:i') : '' }}</td>
                                        <td>{{ $sectorResponsible->date_end ? $sectorResponsible->date_end->format('d/m/Y H:i') : '' }}</td>
                                        <td>{{ $sectorResponsible->situation->name ?? null}}</td>
                                        <td style="display: inline-block; width: 110px;">
                                            @can('sector_responsible.update')
                                            <a href="{{route('sector_responsible.edit',[$sectorResponsible->id])}}"
                                                class="btn btn-sm btn-success float-left">Editar</a>
                                            @endcan
                                            @can('sector_responsible.destroy')
                                            <form action="{{route('sector_responsible.destroy', $sectorResponsible->id)}}" method="post"
                                                class="delete-departmentResponsibles">
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
                text: "{{ session('successDel') }}",
                icon: "success"
            });
        </script>
    @endif

    @if(session('errorDel'))
        <script>
            Swal.fire({
                title: "Atenção!",
                text: '{{ session('errorDel') }}',
                icon: "warning"
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $("#list-departmentResponsibles").DataTable({
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

            $('.delete-departmentResponsibles').submit(function(ev) {
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
        });
    </script>

    @stop
