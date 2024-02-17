@extends('adminlte::page')

@section('title', 'Lista de Unidades Gestoras')

@section('content_header')
<h3></h3>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        @include('shared.success-message')
        @include('shared.error-message')
        <h3 class="card-title">Listagem de Unidades Gestoras</h3>
            @can('management_units.create')
                <a href="{{route('management_units.create')}}" class="btn btn-sm btn-success float-right">NOVA UNIDADE GESTORA</a>
            @endcan
    </div>

    <div class="card-body">
        <div id="list" class="dataTables_wrapper dt-bootstrap4">
            
            <div class="row">
                <div class="col-sm-12">
                    <table id="list-management-units" class="table table-bordered table-striped dataTable dtr-inline"
                        aria-describedby="list-management-units">
                        <thead>
                            <th>ID</th>
                            <th>NOME</th>
                            <th>CÓDIGO</th>
                            <th>TELEFONE</th>
                            <th>EMAIL</th>
                            <th>CNPJ</th>
                            <th>RESPONSÁVEL</th>
                            <th style="width: 20px;">AÇÕES</th>
                        </thead>
                        <tbody>

                        @forelse($units as $unit)
                        <tr>
                            <td>{{ $unit->id }}</td>
                            <td>{{ $unit->name }}</td>
                            <td>{{ $unit->cod }}</td>
                            <td>{{ $unit->phone }}</td>
                            <td>{{ $unit->email }}</td>
                            <td>{{ $unit->cnpj }}</td>
                            <td><a href="#">Teste</a></td>
                            <td style="display: inline-block; width: 110px;">
                                @can('management_units.update')
                                    <a href="{{route('management_units.edit',[$unit->id])}}"
                                        class="btn btn-sm btn-success float-left">Editar
                                    </a>
                                @endcan
                                @can('management_units.destroy')
                                <form action="{{route('management_units.destroy', $unit->id)}}" method="post" class="delete-management-unit">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                </form>
                                @endcan
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="5"> Ainda não há Unidade Gestora cadastrada.</td>
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
          
            $("#list-management-units").DataTable({
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

        $('.delete-management-unit').submit(function(ev) {
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