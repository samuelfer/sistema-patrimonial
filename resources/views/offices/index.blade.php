@extends('adminlte::page')

@section('title', 'Lista de Cargos e Função')

@section('content_header')
<h3></h3>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        @include('shared.success-message')
        @include('shared.error-message')
        <h3 class="card-title">Listagem de Cargos e Funções</h3>
            @can('offices.create')
                <a href="{{route('offices.create')}}" class="btn btn-sm btn-success float-right">NOVO CARGO E FUNÇÃO</a>
            @endcan
    </div>

    <div class="card-body">
        <div id="list" class="dataTables_wrapper dt-bootstrap4">
            
            <div class="row">
                <div class="col-sm-12">
                    <table id="list-offices" class="table table-bordered table-striped dataTable dtr-inline"
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
                                <form action="{{route('offices.delete', $office->id)}}" method="post" class="delete-offices">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                </form>
                                @endcan
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="5"> Ainda não há Cargo e Função cadastrado.</td>
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