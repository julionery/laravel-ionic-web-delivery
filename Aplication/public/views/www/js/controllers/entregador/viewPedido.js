angular.module('starter.controllers')
    .controller('EntregadorViewPedidoCtrl', [
        '$scope', '$stateParams', 'EntregadorPedido', '$ionicPopup', '$ionicLoading', '$cordovaGeolocation',
        function ($scope, $stateParams, EntregadorPedido, $ionicPopup, $ionicLoading, $cordovaGeolocation) {
            var watch, lat = null, long = null;

            $scope.pedido = {};
            $ionicLoading.show({
                template: "Carregando..."
            });

            EntregadorPedido.get({
                id: $stateParams.id,
                include: "items,cupom"
            }, function (data) {
                $scope.pedido = data.data;
                $scope.hora = $scope.pedido.created_at.date.slice(11,16);
                $ionicLoading.hide();
            }, function (dataError) {
                $ionicLoading.hide();
            });

            $scope.entregaRealizada = function () {
                stopWatchPosition();
                EntregadorPedido.updateStatus({id: $stateParams.id}, {status: 4});
                $ionicPopup.alert({
                    title: 'Informação',
                    template: '<center>Atualizado com sucesso!</center>'
                })
            };

            $scope.goToDelivery = function () {
                $ionicPopup.alert({
                    title: 'Informação',
                    template: '<center>Para parar a localização clique no OK</center>'
                }).then(function () {
                    stopWatchPosition();
                });
                EntregadorPedido.updateStatus({id: $stateParams.id}, {status: 3}, function () {
                    var watchOptions = {
                        timeout: 3000,
                        enableHighAccuracy: false
                    };
                    watch = $cordovaGeolocation.watchPosition(watchOptions);
                    watch.then(null,
                        function (responseError) {
                            //error
                        }, function (position) {
                            EntregadorPedido.geo({id: $stateParams.id}, {
                                lat: position.coords.latitude,
                                long: position.coords.longitude
                            })
                        });
                });
            };

            function stopWatchPosition() {
                if (watch && typeof  watch == 'object' && watch.hasOwnProperty('watchID')) {
                    $cordovaGeolocation.clearWatch(watch.watchID);
                }
            }

            $scope.openListPedidos = function () {
                $state.go('entregador.pedido');
            };

        }]);