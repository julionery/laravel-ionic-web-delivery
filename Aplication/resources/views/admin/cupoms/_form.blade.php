<div class="row">
    <p>Campos com <font color="red">*</font> são obrigatórios!</p>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="fg-line">
                {!! Form::label('Código: *') !!}
                {!! Form::text('codigo', null, ['class'=>'form-control', 'autofocus', 'required']) !!}
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="fg-line">
                {!! Form::label('Valor: *') !!}
                {!! Form::number('valor', null, ['class'=>'form-control','step'=>'any', 'required']) !!}
            </div>
        </div>
    </div>
</div>