@extends('adminlte::page')

@section('title', 'Lista de Gestões')

@section('content_header')
<h3></h3>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        @include('shared.success-message')
        @include('shared.error-message')
        <h3 class="card-title">Listagem de Gestões</h3>
            @can('offices.create')
                <a href="{{route('managements.create')}}" class="btn btn-sm btn-success float-right">NOVA GESTÃO</a>
            @endcan
    </div>

    <div class="card-body">
        <div id="list" class="dataTables_wrapper dt-bootstrap4">
            
            <div class="row">
                <div class="col-sm-12">
                    <table id="list-managements" class="table table-bordered table-striped dataTable dtr-inline"
                        aria-describedby="list-managements">
                        <thead>
                            <th>ID</th>
                            <th>INÍCIO</th>
                            <th>FIM</th>
                            <th>ATIVO</th>
                            <th style="width: 20px;">AÇÕES</th>
                        </thead>
                        <tbody>

                        @forelse($managements as $management)
                        <tr>
                            <td>{{ $office->id}}</td>
                            <td>{{ $management->start}}</td>
                            <td>{{ $management->end}}</td>
                            <td>{{ $management->status == 1 ? 'Sim' : 'Não' }}</td>
                            <td style="display: inline-block; width: 110px;">
                                @can('managements.update')
                                    <a href="{{route('managements.edit',[$management->id])}}"
                                        class="btn btn-sm btn-success float-left">Editar
                                    </a>
                                @endcan
                                @can('managements.destroy')
                                <form action="{{route('managements.delete', $management->id)}}" method="post" class="delete-managements">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                </form>
                                @endcan
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="5"> Ainda não há Gestão cadastrada.</td>
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
          
            $("#list-offices").DataTable({
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

        $('.delete-managements').submit(function(ev) {
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