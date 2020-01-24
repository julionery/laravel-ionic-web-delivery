angular.module('starter.services')
    .service('$cart', ['$localStorage', '$ionicPopup', 'Adicional',
        function ($localStorage, $ionicPopup, Adicional) {
            var key = 'cart', cartAux = $localStorage.getObject(key), empresaAux = $localStorage.getObject('empresa');
            var adicionais = {};

            if (!cartAux) {
                initCart();
            }
            this.clear = function () {
                initCart();
            };

            this.get = function () {
                return $localStorage.getObject(key);
            };

            this.getItem = function (i) {
                return this.get().items[i];
            };

            Adicional.query({
                empresa_id: empresaAux.id
            }, function (data) {
                adicionais = data.data;
            }, function (dataError) {
                $state.go('login');
            });

            this.addItem = function (item) {
                var cart = this.get(), itemAux, exists = false;
                /*
                 for(var index in cart.items){
                 itemAux = cart.items[index];
                 if (itemAux.id == item.id){
                 itemAux.qtd = item.qtd + itemAux.qtd;
                 itemAux.subtotal = calculateSubTotal(itemAux);
                 exists = true;
                 break;
                 }
                 }
                 */
                // if(!exists){
                item.subtotal = calculateSubTotal(item);

                var categoria = $localStorage.getObject("categoria");
                item.categoria = categoria;
                cart.items.push(item);
                // }
                cart.total = getTotal(cart.items);
                cart.retirada = 0;
                cart.pagamento = 0;
                cart.troco = 0;
                $localStorage.setObject(key, cart);
            };

            this.removeItem = function (i) {
                var cart = this.get();
                cart.items.splice(i, 1);
                cart.total = getTotal(cart.items);
                $localStorage.setObject(key, cart);
            };

            this.updateItem = function (i, qtd, obs, meia) {
                var cart = this.get(),
                    itemAux = cart.items[i];
                itemAux.qtd = qtd;
                itemAux.obs = obs;
                itemAux.meia = meia;
                itemAux.subtotal = calculateSubTotal(itemAux);
                cart.total = getTotal(cart.items);
                $localStorage.setObject(key, cart);
            };

            this.esvaziarCarrinho = function () {
                $localStorage.setObject(key, {
                    items: [],
                    total: 0,
                    retirada: null,
                    pagamento: null,
                    troco: null,
                    cupom: {
                        codigo: null,
                        valor: null
                    }
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

            this.getTotalFinal = function () {
                var cart = this.get();
                return cart.total - (cart.cupom.valor || 0);
            };

            this.setConfirmation = function (retirada, pagamento, troco) {
                var cart = this.get();

                cart.retirada = retirada;
                cart.pagamento = pagamento;
                cart.troco = troco;

                $localStorage.setObject(key, cart);
            };

            function calculateSubTotal(item) {
                subtotal = item.preco * item.qtd;
                if(item.meia==1){
                    subtotal = subtotal/2;
                }
                for(var index in adicionais){
                    var itemAux = adicionais[index];
                    for(var add in item.adicionar){
                        var itemAdd = item.adicionar[add];
                        if(itemAux.id == itemAdd){
                            subtotal += parseFloat(itemAux.preco);
                        }
                    }
                }
                return subtotal;
            }

            function getTotal(items) {
                var sum = 0, qtdMeiaB = 0, qtdMeiaP = 0, qtdMeiaM = 0, qtdMeiaG = 0;
                angular.forEach(items, function (item) {
                    if(item.meia==1 && item.tamanho == 'B'){
                        qtdMeiaB += item.qtd;
                    }
                    if(item.meia==1 && item.tamanho == 'P'){
                        qtdMeiaP += item.qtd;
                    }
                    if(item.meia==1 && item.tamanho == 'M'){
                        qtdMeiaM += item.qtd;
                    }
                    if(item.meia==1 && item.tamanho == 'G'){
                        qtdMeiaG += item.qtd;
                    }

                    $localStorage.set('qtdMeiaB', qtdMeiaB);
                    $localStorage.set('qtdMeiaP', qtdMeiaP);
                    $localStorage.set('qtdMeiaM', qtdMeiaM);
                    $localStorage.set('qtdMeiaG', qtdMeiaG);
                    
                    sum += item.subtotal;
                });
                return sum;
            }

            function initCart() {
                $localStorage.setObject(key, {
                    items: [],
                    total: 0,
                    empresa_id: null,
                    retirada: null,
                    pagamento: null,
                    troco: null,
                    cupom: {
                        codigo: null,
                        valor: null
                    }
                });
            }

        }]);