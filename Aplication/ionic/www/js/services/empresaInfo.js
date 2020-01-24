angular.module('starter.services')
    .service('$EmpresaInfo', ['$localStorage', function ($localStorage) {
        var key = 'empresa', empresaAux = $localStorage.getObject(key);

        if (!empresaAux){
            initEmpresa();
        }
        this.clear = function () {
            initEmpresa();
        };

        this.get = function () {
            return $localStorage.getObject(key);
        };

        this.getItem = function (i) {
            return this.get().items[i];
        };


        this.addItem = function (item) {
            var cart = this.get(), empresaAux, exists = false;

            for(var index in cart.items){
                empresaAux = cart.items[index];
                if (empresaAux.id == item.id){
                    empresaAux.qtd = item.qtd + empresaAux.qtd;
                    empresaAux.subtotal = calculateSubTotal(empresaAux);
                    exists = true;
                    break;
                }
            }

            if(!exists){
                item.subtotal = calculateSubTotal(item);
                cart.items.push(item);
            }
            cart.total = getTotal(cart.items);
            cart.retirada = 1;
            cart.pagamento = 1;
            cart.troco = 0;
            $localStorage.setObject(key, cart);
        };

        this.updateItem = function (i, qtd, obs, meia) {
            var cart = this.get(), 
            empresaAux = cart.items[i];
            empresaAux.qtd = qtd;
            empresaAux.obs = obs;
            empresaAux.meia = meia;
            empresaAux.subtotal = calculateSubTotal(empresaAux);
            cart.total = getTotal(cart.items);
            $localStorage.setObject(key, cart);
        };

        this.esvaziarEmpresa = function () {
            $localStorage.setObject(key,{
                id: 0,
                nome_fantasia: null,
                telefone: null,
                endereco: null,
                bairro: null,
                cidade: null,
                estado: null,
                cep: null,
                consumacao_minima: 0,
                abertura: null,
                fechamento: null,
                status: 0
            });
        };
        
        this.setEmpresa = function (empresa_id) {
            var cart = this.get();
            cart.empresa_id = empresa_id;
            $localStorage.setObject(key, cart);
        };
        
        this.setCupom = function (codigo, valor) {
            var cart = this.get();
            cart.cupom = {
                codigo: codigo,
                valor: valor
            };
            $localStorage.setObject(key, cart);
        };

        this.removeCupom = function () {
            var cart = this.get();
            cart.cupom = {
                codigo: null,
                valor: null
            };
            $localStorage.setObject(key, cart);
        };

        
        this.setEmpresaDetalhes = function (
                id,
                nome_fantasia, 
                telefone, 
                endereco,
                bairro,
                cidade,
                estado,
                cep,
                consumacao_minima,
                abertura,
                fechamento,
                status
        ) {
            var empresa = this.get();

            empresa.id = id;
            empresa.nome_fantasia = nome_fantasia;
            empresa.telefone = telefone;
            empresa.endereco = endereco;
            empresa.bairro = bairro;
            empresa.cidade = cidade;
            empresa.estado = estado;
            empresa.cep = cep;
            empresa.consumacao_minima = consumacao_minima;
            empresa.abertura = abertura;
            empresa.fechamento = fechamento;
            empresa.status = status;
            
            $localStorage.setObject(key, empresa);
        };

        function initEmpresa() {
            $localStorage.setObject(key,{
                id: 0,
                nome_fantasia: null,
                telefone: null,
                endereco: null,
                bairro: null,
                cidade: null,
                estado: null,
                cep: null,
                consumacao_minima: 0,
                abertura: null,
                fechamento: null,
                status: 0
            });
        }

    }]);