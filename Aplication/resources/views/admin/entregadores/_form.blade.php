<div class="row">
<p>Campos com <font color="red">*</font> são obrigatórios!</p>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="fg-line">
                {!! Form::label('Nome: *') !!}
                {!! Form::text('usuario[nome]', null, ['class'=>'form-control',  'autofocus', 'required']) !!}
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <div class="fg-line">
                {!! Form::label('Email: *') !!}
                {!! Form::email('usuario[email]', null, ['class'=>'form-control', 'required']) !!}
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="fg-line">
                {!! Form::label('Tipo: *') !!}
                {!! Form::select('tipo', array('admin'=> 'Administrador', 'entregador'=> 'Entregador'), null, ['class'=>'form-control'], 'required') !!}
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="fg-line">
                {!! Form::label('Telefone: *') !!}
                {!! Form::text('telefone', null, ['class'=>'form-control input-mask', 'data-mask'=>'(00) 00000-0000', 'placeholder'=>'(00) 00000-0000', 'required']) !!}
            </div>
        </div>
    </div>


    <div class="col-sm-4">
        <div class="form-group">
            <div class="fg-line">
                {!! Form::label('CEP: *') !!}
                {!! Form::text('cep', null, ['class'=>'form-control input-mask', 'data-mask'=>'00000-000', 'placeholder'=>'00000-000', 'required']) !!}
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="fg-line">
                {!! Form::label('Endereço: *') !!}
                {!! Form::text('endereco', null, ['class'=>'form-control', 'required']) !!}
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="fg-line">
                {!! Form::label('Bairro: *') !!}
                {!! Form::text('bairro', null, ['class'=>'form-control', 'required']) !!}
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="fg-line">
                {!! Form::label('Cidade: ') !!}
                {!! Form::text('cidade', null, ['class'=>'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="fg-line">
                {!! Form::label('Estado: ') !!}
                {!! Form::text('estado', null, ['class'=>'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="fg-line">
                {!! Form::label('Sexo: ') !!}
                {!! Form::select('sexo', array('F'=> 'Feminino', 'M'=> 'Masculino', 'O' => 'Outro'), null, ['class'=>'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="fg-line">
                {!! Form::label('Moto - Placa: ') !!}
                {!! Form::text('placa', null, ['class'=>'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="fg-line">
                {!! Form::label('Moto - Modelo: ') !!}
                {!! Form::text('modelo', null, ['class'=>'form-control']) !!}
            </div>
        </div>
    </div>

</div>