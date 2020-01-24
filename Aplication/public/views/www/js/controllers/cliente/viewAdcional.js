angular.module('starter.controllers')
    .controller('ClienteViewAdicionalCtrl', [
        '$scope', '$state', 'Adicional', '$ionicLoading', '$cart', '$ionicPopup','$EmpresaInfo', '$localStorage',
        function ($scope, $state, Adicional, $ionicLoading, $cart, $ionicPopup, $EmpresaInfo, $localStorage) {

            var cart = $cart.get();
            $scope.adicionais = [];
            var empresa_id = cart.empresa_id;
            
            var produto_index = $localStorage.get('produto_index');
            $scope.empresa = $EmpresaInfo.get();

            $ionicLoading.show({
                template: "Carregando..."
            });

            Adicional.query({
                empresa_id: empresa_id,
                orderBy: 'nome'
            }, function (data) {
                $scope.adicionais = data.data;
                $ionicLoading.hide();
            }, function (dataError) {
                $ionicLoading.hide();
                $state.go('login');
            });

            $scope.save = function () {
                camposMarcados = [];
                $("input[type=checkbox][name='adicionais[]']:checked").each(function(){
                    camposMarcados.push($(this).val());
                });

                updateItemAdicionar(produto_index, camposMarcados);
                $state.go('cliente.checkout_item_detalhes');
            };
            
            $scope.openListCheckoutDetalhes = function () {
                $state.go('cliente.checkout_item_detalhes');
            };
            
            updateItemAdicionar = function (i, adicionais) {
                var cart = $cart.get(),
                    itemAux = cart.items[i];
                itemAux.adicionar = adicionais;
                var itensAdicionar = {}, nomesAdicionar = '',
                 aux = 0;
                for(var index in $scope.adicionais){
                    var itemAdicional = $scope.adicionais[index];
                    for(var add in adicionais){
                        var itemAdd = adicionais[add];
                        if(itemAdicional.id == itemAdd){
                            itensAdicionar[aux] = itemAdicional.nome + ' = R$' + itemAdicional.preco;
                            if(nomesAdicionar!=''){
                                nomesAdicionar += ', ';
                            }
                            nomesAdicionar += itemAdicional.nome;
                            aux++;
                        }
                    }
                }
                itemAux.nomesAdicionados = nomesAdicionar;
                itemAux.itensAdicionados = itensAdicionar;
                $localStorage.setObject('cart', cart);
            };
        }]);