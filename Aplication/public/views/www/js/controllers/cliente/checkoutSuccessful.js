angular.module('starter.controllers')
    .controller('ClienteCheckoutSuccessfulCtrl', [
        '$scope', '$state', '$cart', '$ionicHistory',
        function ($scope, $state, $cart, $ionicHistory) {
            var cart = $cart.get();

            $scope.cupom = cart.cupom;  
            $scope.items = cart.items;
            $scope.total = $cart.getTotalFinal();
            $scope.empresa_id = cart.empresa_id;

            if (cart.items == "") {
                $state.go('cliente.pedido');
            }

            $cart.clear();
            
            $scope.openListPedido = function () {
                $state.go('cliente.pedido');
            };
        }]);