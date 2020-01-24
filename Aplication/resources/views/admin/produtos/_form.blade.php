<p>Campos com <font color="red">*</font> são obrigatórios!</p>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <div class="fg-line">
                {!! Form::label('Nome: *') !!}
                {!! Form::text('nome', null, ['class'=>'form-control', 'required']) !!}
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="fg-line">
                {!! Form::label('Descrição: *') !!}
                {!! Form::text('descricao', null, ['class'=>'form-control', 'required']) !!}
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('Categoria','Categoria: *') !!}
            <div class="dropdown">
                {!! Form::select('categoria_id', $categorias, null, ['class'=>'dropdown-toggle btn btn-default', 'required']) !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <div class="fg-line">
                {!! Form::label('Tamanho', 'Tamanho: ') !!}
                {!! Form::select('tamanho', array('N'=> 'Único', 'B'=> 'Broto', 'P' => 'Pequeno','M' => 'Médio', 'G' => 'Grande'), null, ['class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <div class="fg-line">
                {!! Form::label('Preco', 'Preço: *') !!}
                {!! Form::number('preco', null, ['class'=>'form-control','step'=>'any', 'required']) !!}
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-switch" data-ts-color="blue">
                {!! Form::label('Permite adicional?', null, ['for'=>'ts3', 'class'=>'ts-label']) !!}<br><br>
                {!! Form::checkbox('adicionais', null, ['id'=>'ts3','type'=>'checkbox', 'hidden'=>'hidden']) !!}
                {!! Form::label('', null, ['for'=>'ts3', 'class'=>'ts-helper']) !!}
            </div>
        </div>
    </div>
</div>
