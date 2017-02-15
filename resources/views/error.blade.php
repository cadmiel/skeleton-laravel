@extends('layouts.app')

@section('content')

<div class="panel-heading">Erro</div>
<div class="panel-body">
<div class="alert alert-danger">
<strong>Mensagem</strong>: {{ $error->getMessage() }}</br>
    <strong>Codigo</strong>: {{ $error->getCode() }}</br>
        <strong>Arquivo</strong>: {{ $error->getFile() }}</br>
    </div>
</div>
@endsection