angular.module('starter.controllers')
    .controller('ClienteCheckoutConfirmationCtrl', [
        '$scope', '$state', '$stateParams', '$cart', '$ionicLoading', 'ClientePedido', '$ionicPopup', '$EmpresaInfo',
        function ($scope, $state, $stateParams, $cart, $ionicLoading, ClientePedido, $ionicPopup, $EmpresaInfo) {
            var cart = $cart.get();
            $scope.pedido = cart;
            $scope.total = $cart.getTotalFinal();
            var empresa_id = cart.empresa_id;

            $scope.openListCheckout = function () {
                $state.go('cliente.checkout');
            };

            if (cart.items == "") {
                $state.go('cliente.pedido');
            }

            $scope.save = function () {
                var total = $cart.getTotalFinal();
                var retirada = $scope.pedido.retirada;
                var pagamento = $scope.pedido.pagamento;
                var troco = $scope.pedido.troco;

                $cart.setConfirmation(retirada, pagamento, troco);
                
                /*if ((pagamento == 0) && (troco < total)) {
                    if (troco == 0) {
                        $ionicPopup.alert({
                            title: 'Informação',
                            template: '<center>Informe o valor para o troco!</center>'
                        });
                    } else {
                        $ionicPopup.alert({
                            title: 'Informação',
                            template: '<center>Valor para troco inferior ao total!</center>'
                        });
                    }
                } else {
                */
                    var o = {items: angular.copy($scope.pedido.items)};
                    angular.forEach(o.items, function (item) {
                        item.produto_id = item.id;
                    });

                    $ionicLoading.show({
                        template: "Carregando..."
                    });

                    o.empresa_id = empresa_id;
                    o.retirada = retirada;
                    o.pagamento = pagamento;
                    o.troco = troco;

                    if(cart.cupom.valor){
                        o.cupom_codigo = cart.cupom.codigo;
                    }
                    ClientePedido.save({id: null}, o, function (data) {
                        $ionicLoading.hide();
                        $state.go('cliente.checkout_successful');
                    }, function (responseError) {
                        $ionicLoading.hide();
                        $ionicPopup.alert({
                            title: 'Informação',
                            template: '<center>Pedido não realizado!<br>Tente novamente!</center>'
                        });
                    });
                //}
            };
        }]);