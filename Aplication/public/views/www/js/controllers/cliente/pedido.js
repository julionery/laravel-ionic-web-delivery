angular.module('starter.controllers')
    .controller('ClientePedidoCtrl', [
        '$scope', '$state', '$ionicLoading', '$ionicActionSheet', 'ClientePedido', '$ionicPopup', '$timeout', '$window',
        function ($scope, $state, $ionicLoading, $ionicActionSheet, ClientePedido, $ionicPopup ,$timeout, $window) {
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
                    $window.location.reload(true);
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
                $state.go('cliente.view_pedido', {id: pedido.id});
            };

            $scope.showActionSheet = function (pedido) {
                $ionicActionSheet.show({
                    buttons:[
                        {text: 'Ver Detalhes'},
                        {text: 'Ver Entrega'}
                    ],
                    titleText: 'O que fazer?',
                    cancelText: 'Cancelar',
                    cancel: function () {
                        //fazer alguma coisa para o cancelamento
                    },
                    buttonClicked: function (index) {
                        switch (index){
                            case 0:
                                $state.go('cliente.view_pedido', {id: pedido.id});
                                break;
                            case 1:
                                if(pedido.status == 3){
                                $state.go('cliente.view_entrega', {id: pedido.id});
                                }else{
                                    $ionicPopup.alert({
                                        title: 'Informação',
                                        template: '<center>Pedido não está em status de entrega!</center>'
                                    });
                                }
                                break;
                        }
                    }
                })
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
                return ClientePedido.query({
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