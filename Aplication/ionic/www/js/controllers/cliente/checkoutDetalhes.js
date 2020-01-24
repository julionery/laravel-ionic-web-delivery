angular.module('starter.controllers')
    .controller('ClienteCheckoutDetalhesCtrl', [
        '$scope', '$state', '$localStorage', '$cart', '$ionicPopup',
        function ($scope, $state, $localStorage, $cart, $ionicPopup) {
            var index = $localStorage.get('produto_index');

            $scope.produto = $cart.getItem(index);
            var produtoAux = $scope.produto;

            if(produtoAux.tamanho!="" && produtoAux.tamanho!="N"){
                $scope.tipoProduto = 1;
            }
            
            $scope.updateItem = function () {
                if($scope.produto.qtd<=0){
                    $ionicPopup.alert({
                        title: 'Informação',
                        template: '<center>Informe a quantidade!</center>'
                    });
                }else{
                $cart.updateItem(index, $scope.produto.qtd, $scope.produto.obs, $scope.produto.meia);
                $state.go('cliente.checkout');
                }
            };

            $scope.openListAdicionais = function () {
                $cart.updateItem(index, $scope.produto.qtd, $scope.produto.obs, $scope.produto.meia);
                $state.go('cliente.view_adicionais');
            };

            $scope.openListRemove = function () {
                $cart.updateItem(index, $scope.produto.qtd, $scope.produto.obs, $scope.produto.meia);
                $state.go('cliente.view_remove');
            };

            $scope.openListCheckout = function () {
                $state.go('cliente.checkout');
            };
        }]);