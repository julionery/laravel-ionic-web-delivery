<div class="row">

    <p>Campos com * são obrigatórios!</p>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="fg-line">
                {!! Form::label('CNPJ: *') !!}
                {!! Form::text('cnpj', null, ['class'=>'form-control input-mask', 'data-mask'=>'00.000.000/0000-00', 'placeholder'=>'00.000.000/0000-00', 'autofocus', 'required']) !!}
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="fg-line">
                {!! Form::label('Razão Social: *') !!}
                {!! Form::text('razao_social', null, ['class'=>'form-control', 'required']) !!}
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="fg-line">
                {!! Form::label('Nome Fantasia: *') !!}
                {!! Form::text('nome_fantasia', null, ['class'=>'form-control', 'required']) !!}
            </div>
        </div>
    </div>


    <div class="col-sm-4">
        <div class="form-group">
            <div class="fg-line">
                {!! Form::label('Telefone:') !!}
                {!! Form::text('telefone', null, ['class'=>'form-control input-mask', 'data-mask'=>'(00) 00000-0000', 'placeholder'=>'(00) 00000-0000']) !!}
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="fg-line">
                {!! Form::label('Endereço:') !!}
                {!! Form::text('endereco', null, ['class'=>'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="fg-line">
                {!! Form::label('Bairro:') !!}
                {!! Form::text('bairro', null, ['class'=>'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="col-sm-4">
    <div class="form-group">
            <div class="fg-line">
                {!! Form::label('CEP:') !!}
                {!! Form::text('cep', null, ['class'=>'form-control input-mask', 'data-mask'=>'00000-000', 'placeholder'=>'00000-000']) !!}
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="fg-line">
                {!! Form::label('Cidade:') !!}
                {!! Form::text('cidade', null, ['class'=>'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="fg-line">
                {!! Form::label('Estado:') !!}
                {!! Form::text('estado', null, ['class'=>'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="col-sm-4">
    <div class="form-group">
            <div class="fg-line">
                {!! Form::label('Consumação Mínima:') !!}
                {!! Form::text('consumacao_minima', null, ['class'=>'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group">
            <div class="dtp-container fg-line">
                {!! Form::label('Horário Abertura:') !!}
                {!! Form::text('abertura', null, ['class'=>'form-control input-mask', 'data-mask'=>'00:00', 'placeholder'=>'__:__']) !!}
            </div>
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group">
            <div class="dtp-container fg-line">
                {!! Form::label('Horário Fechamento:') !!}
                {!! Form::text('fechamento', null, ['class'=>'form-control input-mask', 'data-mask'=>'00:00', 'placeholder'=>'__:__']) !!}
            </div>
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group">
            <div class="toggle-switch" data-ts-color="blue">
                {!! Form::label('Status:', null, ['for'=>'ts3', 'class'=>'ts-label']) !!}<br><br>
                {!! Form::checkbox('status', null, ['id'=>'ts3','type'=>'checkbox', 'hidden'=>'hidden']) !!}
                {!! Form::label('', null, ['for'=>'ts3', 'class'=>'ts-helper']) !!}
            </div>
        </div>
    </div>

</div>