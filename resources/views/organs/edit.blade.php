@extends('adminlte::page')

@section('title', 'Editar órgão')

@section('content_header')
<h3></h3>
@stop

@section('content')

<div class="row">

    <div class="col-md-12">
        @include('shared.error-message')

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Editar Órgão</h3>
            </div>


            <form action="{{route('organs.update',[$organ->id])}}" method="post" >
                @csrf
                @method('PUT')
                <div class="card-body">

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                value="{{$organ->name}}" name='name'
                                id="name" placeholder="Digite um nome" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="form-group col-md-2">
                            <label for="sigla">Sigla</label>
                            <input type="text" class="form-control @error('sigla') is-invalid @enderror"
                                value="{{$organ->sigla}}" name='sigla' id="sigla"
                                placeholder="Digite uma sigla" value="{{ old('sigla') }}">
                                @error('sigla')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="management_unit_id">Selecione a Unidade Gestora</label>
                            <select class="js-basic form-control" name="management_unit_id">
                                <option value="">Selecione</option>
                                    @foreach($managementUnits as $unit)
                                        <option @if ($unit->id == $organ->management_unit_id) selected @endif
                                         value="{{ $unit->id }}">{{ $unit->name }}</option>
                                    @endforeach
                            </select>
                            @error('management_unit_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="row">

                        <div class="form-group col-md-5">
                            <label for="phone">Telefone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                value="{{$organ->phone}}" name='phone' id="phone"
                                placeholder="Digite um telefone" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="form-group col-md-5">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{$organ->email}}"name='email' id="email"
                                placeholder="Digite um email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>


                        <div class="form-group col-md-2">
                            <label for="status">Status</label>
                            <select class="js-basic form-control" name="status">
                                <option value="">Selecione</option>
                                <option value="1" @if ($organ->status == 1) selected @endif>Sim</option>
                                <option value="0" @if ($organ->status == 0) selected @endif>Não</option>
                            </select>
                            @error('status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Endereço</label>
                        <input type="address" class="form-control @error('address') is-invalid @enderror"
                            value="{{$organ->address}}" name="address" id="address" placeholder="Digite o endereço">
                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <input type="description" class="form-control @error('description') is-invalid @enderror"
                            value="{{$organ->description}}" name="description" id="description" placeholder="Digite a descrição">
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <a href="{{route('organs.view')}}" type="button" class="btn btn-default">Cancelar</a>
                </div>
            </form>
        </div>


    </div>

</div>

@stop
