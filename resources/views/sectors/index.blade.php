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
        <h3 class="card-title">Listagem de Setores</h3>
            @can('management_units.create')
                <a href="{{route('sectors.create')}}" class="btn btn-sm btn-success float-right">NOVO SETOR</a>
            @endcan
    </div>

    <div class="card-body">
        <div id="list" class="dataTables_wrapper dt-bootstrap4">
            
            <div class="row">
                <div class="col-sm-12">
                    <table id="list-sectors" class="table table-bordered table-striped dataTable dtr-inline"
                        aria-describedby="list-sectors">
                        <thead>
                            <th>ID</th>
                            <th>NOME</th>
                            <th>CÓDIGO</th>
                            <th>UNID. GESTORA</th>
                            <th style="width: 20px;">AÇÕES</th>
                        </thead>
                        <tbody>

                        @forelse($sectors as $sector)
                        <tr>
                            <td>{{ $sector->id}}</td>
                            <td>{{ $sector->name}}</td>
                            <td>{{ $sector->cod}}</td>
                            <td>{{ $sector->managementUnit->name}}</td>
                            <td style="display: inline-block; width: 110px;">
                                @can('sectors.update')
                                    <a href="{{route('sectors.edit',[$sector->id])}}"
                                        class="btn btn-sm btn-success float-left">Editar
                                    </a>
                                @endcan
                                @can('sectors.destroy')
                                <form action="{{route('sectors.delete', $sector->id)}}" method="post" class="delete-sectors">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                </form>
                                @endcan
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="5"> Ainda não há Setor cadastrado.</td>
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
          
            $("#list-sectors").DataTable({
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

        $('.delete-sectors').submit(function(ev) {
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