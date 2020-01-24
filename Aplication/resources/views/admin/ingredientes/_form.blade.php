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
</div>