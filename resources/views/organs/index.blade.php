@extends('adminlte::page')

@section('title', 'Lista de Setores')

@section('content_header')
<h3></h3>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        @include('shared.success-message')
        @include('shared.error-message')
        <h3 class="card-title">Listagem de Órgãos</h3>
            @can('management_units.create')
                <a href="{{route('organs.create')}}" class="btn btn-sm btn-success float-right">NOVO ÓRGÃO</a>
            @endcan
    </div>

    <div class="card-body">
        <div id="list" class="dataTables_wrapper dt-bootstrap4">
            
            <div class="row">
                <div class="col-sm-12">
                    <table id="list-organs" class="table table-bordered table-striped dataTable dtr-inline"
                        aria-describedby="list-organs">
                        <thead>
                            <th>ID</th>
                            <th>NOME</th>
                            <th>SIGLA</th>
                            <th>UNID. GESTORA</th>
                            <th>ENDEREÇO</th>
                            <th>ATIVO</th>
                            <th>RESPONSÁVEL</th>
                            <th style="width: 20px;">AÇÕES</th>
                        </thead>
                        <tbody>

                        @forelse($organs as $organ)
                        <tr>
                            <td>{{ $organ->id }}</td>
                            <td>{{ $organ->name }}</td>
                            <td>{{ $organ->sigla }}</td>
                            <td>{{ $organ->managementUnit->name }}</td>
                            <td>{{ $organ->address }}</td>
                            <td>{{ $organ->status == 1 ? 'Sim' : 'Não' }}</td>
                            <td>{{ $organ->people?->name }}</td>
                            <td style="display: inline-block; width: 110px;">
                                @can('organs.update')
                                    <a href="{{route('organs.edit',[$organ->id])}}"
                                        class="btn btn-sm btn-success float-left">Editar
                                    </a>
                                @endcan
                                @can('organs.destroy')
                                <form action="{{route('organs.destroy', $organ->id)}}" method="post" class="delete-organs">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                </form>
                                @endcan
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="5"> Ainda não há órgão cadastrado.</td>
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

        $(function () {
          
            $("#list-organs").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
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

        $('.delete-organs').submit(function(ev) {
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