angular.module('starter.controllers')
    .controller('ClienteViewPedidoCtrl', [
        '$scope', '$state', '$stateParams', 'ClientePedido', '$ionicLoading',
        function ($scope, $state, $stateParams, ClientePedido, $ionicLoading) {
            $scope.pedido = [];
            var subtotal = 0;

            $ionicLoading.show({
                template: "Carregando..."
            });

            ClientePedido.get({
                id: $stateParams.id,
                include: "items,cupom"
            }, function (data) {
                $scope.pedido = data.data;
                $scope.hora = $scope.pedido.created_at.date.slice(11,16);
                angular.forEach($scope.pedido.items.data, function (item) {
                    subtotal = item.preco * item.qtd;
                    if(item.meia==1){
                        subtotal = subtotal/2;
                        item.preco = item.preco/2;
                    }
                    for(var index in item.componentes.data){
                        var itemAux = item.componentes.data[index];
                        subtotal += parseFloat(itemAux.preco);
                    }
                    item.subtotal = subtotal;
                });
                $ionicLoading.hide();
            }, function (dataError) {
                $ionicLoading.hide();
            });


            $scope.openViewEntrega = function () {
                $state.go('cliente.view_entrega', {id: $stateParams.id});
            };
            $scope.openListPedidos = function () {
                $state.go('cliente.pedido');
            };

        }]);