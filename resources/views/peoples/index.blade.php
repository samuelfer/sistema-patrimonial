@extends('adminlte::page')

@section('title', 'Pessoas')

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
                <h3 class="card-title">Lista de Pessoas</h3>
                @can('peoples.create')
                <a href="{{route('peoples.create')}}" class="btn btn-sm btn-success float-right">NOVA PESSOA</a>
                @endcan
            </div>

            <div class="card-body">
                <div id="list" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">

                            <table id="list-peoples" class="table table-bordered table-striped dataTable dtr-inline"
                                aria-describedby="list-peoples">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOME</th>
                                        <th>EMAIL</th>
                                        <th>STATUS</th>
                                        <th>MATRÍCULA</th>
                                        <th style="width: 20px;">AÇÕES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($peoples as $people)
                                    <tr>
                                        <td>{{ $people->id }}</td>
                                        <td>{{ $people->name }}</td>
                                        <td>{{ $people->email }}</td>
                                        <td>{{ $people->status == 1 ? 'Sim' : 'Não'}}</td>
                                        <td>{{ $people->matricula }}</td>
                                        <td style="display: inline-block; width: 110px;">
                                            @can('peoples.update')<a href="{{route('peoples.edit',[$people->id])}}"
                                                class="btn btn-sm btn-success float-left">Editar</a>@endcan
                                            @can('peoples.destroy')
                                            <form action="{{route('peoples.destroy', $people->id)}}" method="post"
                                                class="delete-people">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                            </form>
                                            @endcan
                                        </td>
                                    </tr>

                                    @empty
                                    <tr>
                                        <td colspan="5"> Ainda não há pessoa cadastrada.</td>
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

        $("#list-peoples").DataTable({
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

    $('.delete-people').submit(function(ev) {
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
