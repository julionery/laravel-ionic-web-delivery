<div class="row">
    <p>Campos com <font color="red">*</font> são obrigatórios!</p>

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
                {!! Form::label('Preço: *') !!}
                {!! Form::number('preco', null, ['class'=>'form-control','step'=>'any', 'required']) !!}
            </div>
        </div>
    </div>

    <div class="col-sm-8">
        <div class="form-group">
            <div class="fg-line">
                {!! Form::label('Descrição:') !!}
                {!! Form::text('descricao', null, ['class'=>'form-control']) !!}
            </div>
        </div>
    </div>

</div>