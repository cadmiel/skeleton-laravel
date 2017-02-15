@extends('layouts.app')

@section('content')

    <div class="panel-heading">Dashboard</div>

    <div class="panel-body">
        @include('partials.alerts')
        {!! Form::model($user,['class'=>'']) !!}

        <div class="row">
            <div class="form-group col-md-6">
                {!! Form::label('name', 'Nome', ['class' => 'control-labell']) !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'autofocus' => '']) !!}
            </div>

            <div class="form-group col-md-6">
                {!! Form::label('email', 'E-mail', ['class' => 'control-labell']) !!}
                {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'autofocus' => '']) !!}
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-9">
                {!! Form::label('password', 'Senha', ['class' => 'control-labell']) !!}
                {!! Form::text('password', null, ['class' => 'form-control', 'id' => 'password', 'autofocus' => '']) !!}
            </div>
            <div class="form-group col-md-3">
                {!! Form::label('status', 'Status', ['class' => 'control-label']) !!}
                {!! Form::select('status', status(), null, ['class' => 'form-control', 'id' => 'status']) !!}
            </div>
        </div>

        <button class="btn btn-primary">Salvar</button>
        <a href="{{route('user.index')}}" class="btn btn-danger">Cancelar</a>

        {!! Form::close() !!}

    </div>

@endsection
