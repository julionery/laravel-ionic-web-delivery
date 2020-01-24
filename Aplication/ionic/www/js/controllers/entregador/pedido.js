angular.module('starter.controllers')
    .controller('EntregadorPedidoCtrl', [
        '$scope', '$state', '$ionicLoading', 'EntregadorPedido', '$ionicPopup', '$timeout', '$window', '$ionicActionSheet',
        function ($scope, $state, $ionicLoading, EntregadorPedido, $ionicPopup, $timeout, $window, $ionicActionSheet) {
            var page = 1;
            $scope.items = [];
            $scope.canMoreItems = true;

            /*
            $ionicLoading.show({
                template: "Carregando..."
            });
            */
            
            $scope.doRefresh = function () {
                page = 1;
                $scope.items =[];
                $scope.canMoreItems = true;
                $scope.loadMore();
                $timeout(function () {
                    //$window.location.reload(true);
                    $scope.$broadcast('scroll.refreshComplete');
                },200);
                /*
                getPedidos().then(function(data){
                    $scope.items = data.data;
                    $scope.$broadcast('scroll.refreshComplete');
                }, function(dataError){
                    $scope.$broadcast('scroll.refreshComplete');
                    $ionicPopup.alert({
                        title: 'Informação',
                        template: '<center>Falha na atualização!</center>'
                    });
                })*/
            };

            $scope.openOrderDetail = function (pedido) {
                if(pedido.status == 5){
                    $ionicPopup.alert({
                        title: 'Informação',
                        template: '<center>Pedido Cancelado!</center>'
                    });
                }else{
                    $state.go('entregador.view_pedido', {id: pedido.id});
                }
            };

            $scope.loadMore = function () {
                getPedidos().then(function (data) {
                    $scope.items = $scope.items.concat(data.data);
                    $scope.totalItems = data.meta.pagination.total;
                    if($scope.items.length == data.meta.pagination.total){
                        $scope.canMoreItems = false;
                    }
                    page += 1;
                    $scope.$broadcast('scroll.infiniteScrollComplete');

                });
            };


            function getPedidos() {
                return EntregadorPedido.query({
                    id: null,
                    page: page,
                    orderBy: 'created_at',
                    sortedBy: 'desc'
                }).$promise;
            }

            /*
            getPedidos().then(function (data) {
                    $scope.items = data.data;
                    $ionicLoading.hide();
                }, function (dataError) {
                    $ionicLoading.hide();
            });
            */
        }]);