angular.module('starter.controllers')
    .controller('ClienteViewEntregaCtrl', [
        '$scope', '$stateParams', 'ClientePedido', 'UserData',  '$ionicLoading', '$ionicPopup', '$pusher', '$window', '$map', 'uiGmapGoogleMapApi',
        function ($scope, $stateParams, ClientePedido, UserData,  $ionicLoading, $ionicPopup, $pusher, $window, $map, uiGmapGoogleMapApi) {
            var iconUrl = 'http://maps.google.com/mapfiles/kml/pal2/';
            $scope.pedido = {};

            $scope.map = $map;

            $scope.markers = [];

            $ionicLoading.show({
                template: "Carregando..."
            });

            uiGmapGoogleMapApi.then(function (maps) {
                $ionicLoading.hide();
            }, function (error) {
                $ionicLoading.hide();
            });

            ClientePedido.get({
                id: $stateParams.id,
                include: "items,cupom"
            }, function (data) {
                $scope.pedido = data.data;
                if (parseInt($scope.pedido.status, 10) == 3) {
                    initMarkers($scope.pedido);
                } else {
                    $ionicPopup.alert({
                        title: 'Informação',
                        template: '<center>Pedido não está em status de entrega!</center>'
                    });
                }
            });

            $scope.$watch('markers.length', function (value) {
                if (value == 2) {
                    createBounds();
                }
            });
            
            function initMarkers(pedido) {
                var cliente = UserData.get().cliente.data,
                    endereco = cliente.cep + ', ' +
                        cliente.endereco + ', ' +
                        cliente.bairro + ', ' +
                        cliente.cidade + ' - ' +
                        cliente.estado;
                createMarkerCliente(endereco);
                watchPositionEntregador(pedido.hash);
            }

            function createMarkerCliente(endereco) {
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                    address: endereco
                }, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        var lat = results[0].geometry.location.lat(),
                            long = results[0].geometry.location.lng();

                        $scope.markers.push({
                            id: 'cliente',
                            coords: {
                                latitude: lat,
                                longitude: long
                            },
                            options: {
                                title: 'Local de entrega!',
                                icon: iconUrl + 'icon10.png'
                            }
                        });
                    } else {
                        $ionicPopup.alert({
                            title: 'Informação',
                            template: '<center>Não foi possível encontrar o seu endereço!</center>'
                        });
                    }
                });
            };

            function watchPositionEntregador(channel) {
                var pusher = $pusher($window.cliente);
                channel = pusher.subscribe(channel);
                channel.bind('WebDelivery\\Events\\GetLocationEntregador', function (data) {
                    var lat = data.geo.lat, long = data.geo.long;

                    if ($scope.markers.length == 1 || $scope.markers.length == 0) {
                        $scope.markers.push({
                            id: 'entregador',
                            coords: {
                                latitude: lat,
                                longitude: long
                            },
                            options: {
                                title: 'Entregador!',
                                icon: iconUrl + 'icon47.png'
                            }
                        });
                        return;
                    }
                    for (var key in $scope.markers) {
                        if ($scope.markers[key].id == 'entregador') {
                            $scope.markers[key].coords = {
                                latitude: lat,
                                longitude: long
                            }
                        }
                    }
                });
            };

            function createBounds() {
                var bounds = new google.maps.LatLngBounds(),
                    latlng;
                angular.forEach($scope.markers, function (value) {
                    latlng = new google.maps.LatLng(Number(value.coords.latitude), Number(value.coords.longitude));
                    bounds.extend(latlng);
                });
                $scope.map.bounds = {
                    northeast: {
                        latitude: bounds.getNorthEast().lat(),
                        longitude: bounds.getNorthEast().lng()
                    },
                    southwest: {
                        latitude: bounds.getSouthWest().lat(),
                        longitude: bounds.getSouthWest().lng()
                    }
                };
            }
        }])

    .controller('CveControlDescentralize', ['$scope', '$map', function ($scope, $map) {
        $scope.map = $map;
        $scope.fit = function () {
            $scope.map.fit = !$scope.map.fit;
        }
    }])

    .controller('CveControlReload', ['$scope', '$window', '$timeout', function ($scope, $window, $timeout) {
        $scope.reload = function () {
            $timeout(function () {
                $window.location.reload(true);
            },100);
        }
    }]);