@extends('layouts.app')

@section('content')

    <div class="panel-heading">Listar | Usuários</div>

    <div class="panel-body">

        @include('partials.alerts')

        <div class="row">
            <div class="col-lg-12 text-right">
                <div>
                    <strong>Página</strong> {!! $usuarios->currentPage() !!} <strong>Total de registro</strong> {!! $usuarios->total() !!}
                </div>
            </div>
        </div>
        <hr style="margin: 5px 0px 5px 0px;">

        <div class="col-md-12" style="font-size: 13px;">
            @include('partials.filter')
        </div>

        <table class="table table-hover table-curved">
            <thead>
            <tr>
                <th>
                    <a title="Ordenar coluna"
                       href="/usuarios/?order=id,{{ ($request['order'][0]=='id' AND $request['order'][1]=='desc')?'asc':'desc' }}">Id</a>
                </th>
                <th>
                    <a title="Ordenar coluna"
                       href="/usuarios/?order=name,{{ ($request['order'][0]=='name' AND $request['order'][1]=='desc')?'asc':'desc' }}">Nome</a>
                </th>
                <th>
                    <a title="Ordenar coluna"
                       href="/usuarios/?order=email,{{ ($request['order'][0]=='email' AND $request['order'][1]=='desc')?'asc':'desc' }}">Email</a>
                </th>
                <th>
                    <a title="Ordenar coluna"
                       href="/usuarios/?order=created_at,{{ ($request['order'][0]=='created_at' AND $request['order'][1]=='desc')?'asc':'desc' }}">Cadastro</a>
                </th>
                <th>
                    <a title="Ordenar coluna"
                       href="/usuarios/?order=updated_at,{{ ($request['order'][0]=='updated_at' AND $request['order'][1]=='desc')?'asc':'desc' }}">Atualizado</a>
                </th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @if(count($usuarios))
                @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->created_at->format('d/m/Y') }}</td>
                    <td>{{ $usuario->updated_at->format('d/m/Y') }}</td>
                    <td width="1%" nowrap>
                        <a href="" class="btn btn-success btn-xs">
                            <i class="fa fa-fw fa-pencil"></i> visualizar
                        </a>
                        <a href="{{route('user.edit',['id'=>$usuario->id])}}" class="btn btn-primary btn-xs">
                            <i class="fa fa-fw fa-pencil"></i> editar
                        </a>
                        <a href="{{route('user.destroy',['id'=>$usuario->id])}}" class="btn btn-danger btn-xs">
                            <i class="fa fa-fw fa-remove"></i> remover
                        </a>
                    </td>
                </tr>
                @endforeach
            @else
            <tr>
                <td colspan="6" class="text-center">Nenhum registro encontrado!!!</td>
            </tr>
            @endif
            </tbody>
        </table>
        {{ $usuarios->links() }}
    </div>

    @endsection
