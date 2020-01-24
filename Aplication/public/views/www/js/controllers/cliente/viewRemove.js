angular.module('starter.controllers')
    .controller('ClienteViewRemoveCtrl', [
        '$scope', '$state', '$ionicLoading', '$cart', '$localStorage', '$stateParams',
        function ($scope, $state, $ionicLoading, $cart,  $localStorage, $stateParams) {
            var cart = $cart.get();
            var produto_index = $localStorage.get('produto_index');

            $scope.produto = $cart.getItem(produto_index);
            $scope.componentes = $scope.produto.componentes;

            $scope.save = function () {
                camposMarcados = [];
                $("input[type=checkbox][name='ingredientes[]']:checked").each(function(){
                    camposMarcados.push($(this).val());
                });

                updateItemRemover(produto_index, camposMarcados);
                $state.go('cliente.checkout_item_detalhes');
            };

            $scope.openListCheckoutDetalhes = function () {
                $state.go('cliente.checkout_item_detalhes');
            };

            updateItemRemover = function (i, remover) {
                var cart = $cart.get(),
                    itemAux = cart.items[i];

                itemAux.remover = remover;

                var itensRemover = {}, nomesRemover = '',
                    aux = 0;

                angular.forEach($scope.componentes.data, function (index) {
                    var itemRemove = index;
                    for(var rem in remover){
                        var itemAdd = remover[rem];
                        if(itemRemove.id == itemAdd){
                            itensRemover[aux] = itemRemove.nome;
                            if(nomesRemover!=''){
                                nomesRemover += ', ';
                            }
                            nomesRemover += itemRemove.nome;
                            aux++;
                        }
                    }
                });
                itemAux.nomesRemovidos = nomesRemover;
                itemAux.itensRemovidos = itensRemover;
                $localStorage.setObject('cart', cart);
            };
        }]);