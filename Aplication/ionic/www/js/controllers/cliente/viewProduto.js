angular.module('starter.controllers')
    .controller('ClienteViewProdutoCtrl', [
        '$scope', '$state', 'Produto', '$ionicLoading', '$cart', '$ionicPopup','$EmpresaInfo', '$localStorage',
        function ($scope, $state, Produto, $ionicLoading, $cart, $ionicPopup, $EmpresaInfo, $localStorage) {
            var cart = $cart.get();
            $scope.produtos = [];
            var empresa_id = cart.empresa_id;
            var categoria = $localStorage.getObject('categoria');
            $scope.categoria = categoria;
            $scope.empresa = $EmpresaInfo.get();

            if(!empresa_id){
                $state.go('cliente.view_empresas');
            }
            
            $scope.openListCategorias = function () {
                $state.go('cliente.view_categorias');
            };
            
            $ionicLoading.show({
                template: "Carregando..."
            });

            Produto.query({
                categoria_id: categoria.id,
                orderBy: 'nome'
            }, function (data) {
                $scope.produtos = data.data;

                angular.forEach($scope.produtos, function (item) {
                   if(item.tamanho=='B' && $scope.empresa.id==item.empresa_id){
                       $scope.broto = 1;
                   }
                    if(item.tamanho=='P' && $scope.empresa.id==item.empresa_id){
                        $scope.pequena = 1;
                    }
                    if(item.tamanho=='M' && $scope.empresa.id==item.empresa_id){
                        $scope.media = 1;
                    }
                    if(item.tamanho=='G' && $scope.empresa.id==item.empresa_id){
                        $scope.grande = 1;
                    }
                });

                
                $ionicLoading.hide();
            }, function (dataError) {
                $ionicLoading.hide();
                $state.go('login');
            });

            $scope.addItem = function (item) {
                item.qtd = 1;
                $cart.addItem(item);
                $state.go('cliente.checkout');
            };
        }]);