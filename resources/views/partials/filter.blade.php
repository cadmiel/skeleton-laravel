{!! Form::open(['method'=>'get']) !!}
<div class="form-group col-md-2">

    {!! Form::label('start_date', 'Data inicio:', ['class' => 'control-labell']) !!}
    <div class="input-group date" data-provide="datepicker">
        {!! Form::text('start_date', checkIfValueExist($request,'start_date'),
        ['data-format'=>'dd/MM/YYYY',
        'class' => 'form-control datetimepicker width-datapicker',
        'id' => 'start_date'])
        !!}
        <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <span class="glyphicon glyphicon-dashboard"></span>
                        </button>
                    </span>
    </div>
</div>
<div class="form-group col-md-2">
    {!! Form::label('end_date', 'Data final:', ['class' => 'control-labell']) !!}
    <div class="input-group date" data-provide="datepicker">
        {!! Form::text('end_date', checkIfValueExist($request,'end_date'),
        ['data-format'=>'dd/MM/YYYY','class' => 'form-control datetimepicker width-datapicker', 'id' => 'end_date'])
        !!}
        <span class="input-group-btn add-on ">
                        <button class="btn btn-default " type="button">
                            <span class="glyphicon glyphicon-dashboard "></span>
                        </button>
                    </span>
    </div>
</div>

<div class="form-group col-md-8">
    {!! Form::label('term', 'Pesquisar por: &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Coluna&emsp;&emsp;&emsp;Critério:', ['class' =>
    'control-labell']) !!}
    <div class="input-group">
        {!! Form::text('term', checkIfValueExist($request,'term'), ['class' => 'form-control', 'id' =>
        'term']) !!}
        <span class="input-group-btn">
                    <span class="btn btn-default">
                        {!! Form::select('column', $column, checkIfValueExist($request,'column'), ['class' => 'column', 'id' => 'column']) !!}
                    </span>
                    <span class="btn btn-default">
                        {!! Form::select('operator', $operator, checkIfValueExist($request,'operator'), ['class' => 'column', 'id' => 'column']) !!}
                    </span>
                    <button class="btn btn-success" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                    <span class="btn btn-success"
                          alt="Cancelar filtro" title="Cancelar filtro">
                        <a
                                href="{{route('user.index')}}"
                                class="glyphicon glyphicon-ban-circle " style="color: #ffffff;"></a>
                    </span>
                    <span class="btn btn-success"
                          alt="Novo usuário" title="Novo usuário">
                        <a
                                href="{{route('user.form')}}"
                                class="glyphicon glyphicon-plus" style="color: #ffffff;"></a>
                    </span>
                    <span class="btn btn-success"
                          alt="Exportar usuários" title="Exportar usuários">
                        <a
                                href="{{route('user.form')}}"
                                class="glyphicon glyphicon-export" style="color: #ffffff;"></a>
                    </span>
                 </span>
    </div>
</div>

{!! Form::close() !!}