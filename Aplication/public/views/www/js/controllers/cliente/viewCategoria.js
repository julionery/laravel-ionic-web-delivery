angular.module('starter.controllers')
    .controller('ClienteViewCategoriaCtrl', [
        '$scope', '$state', 'Categoria', '$ionicLoading', '$cart', '$ionicPopup','$EmpresaInfo', '$localStorage',
        function ($scope, $state, Categoria, $ionicLoading, $cart, $ionicPopup, $EmpresaInfo, $localStorage) {

            var cart = $cart.get();
            $scope.categorias = [];
            var empresa_id = cart.empresa_id;

            $scope.empresa = $EmpresaInfo.get();

            if(!empresa_id){
                $state.go('cliente.view_empresas');
            }

            $ionicLoading.show({
                template: "Carregando..."
            });

            Categoria.query({
                empresa_id: empresa_id,
                orderBy: 'nome'
            }, function (data) {
                $scope.categorias = data.data;
                $ionicLoading.hide();
            }, function (dataError) {
                $ionicLoading.hide();
                $state.go('login');
            });

            $scope.openListProdutos = function (item) {
                $localStorage.setObject('categoria', item);
                $state.go('cliente.view_produtos');
            };

            $scope.openListEmpresas = function () {
                if ($cart.get().items != ''){
                var confirmPopup = $ionicPopup.confirm({
                        title: 'Informação - Pedido',
                        template: 'Existem itens pendentes no pedido!<br><br>Deseja cancelar e sair?'
                    });
                    confirmPopup.then(function(resposta) {
                        if(resposta) {
                            $cart.esvaziarCarrinho();
                            $state.go('cliente.view_empresas');
                        }
                    });
                }else{
                    $state.go('cliente.view_empresas');
                }
            };
        }]);