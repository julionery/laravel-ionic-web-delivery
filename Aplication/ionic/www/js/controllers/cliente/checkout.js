angular.module('starter.controllers')
    .controller('ClienteCheckoutCtrl', [
        '$scope', '$state', '$cart', '$ionicLoading', '$ionicPopup', 'Cupom', '$EmpresaInfo', '$cordovaBarcodeScanner', 'User', '$localStorage', 'Adicional',
        function ($scope, $state, $cart, $ionicLoading, $ionicPopup, Cupom, $EmpresaInfo,  $cordovaBarcodeScanner, User, $localStorage, Adicional) {
            User.authenticated({include: 'cliente'},function (data) {
            }, function () {
                $state.go('login');
            });

            var cart = $cart.get();
            var empresaAux = $EmpresaInfo.get();
            $scope.cupom = cart.cupom;
            $scope.items = cart.items;
            $scope.total = $cart.getTotalFinal();

            if($scope.total < empresaAux.consumacao_minima){
                $ionicPopup.alert({
                    title: 'Informação',
                    template: '<center>Consumação mímina obrigatória!</center>'
                });
                $scope.consumacao_minima = empresaAux.consumacao_minima;
            }

            if (cart.items == "") {
                $state.go('cliente.view_produtos');
            }

            $scope.removeItem = function (i) {
                $cart.removeItem(i);
                $scope.items.splice(i, 1);
                $scope.total = $cart.getTotalFinal();

                if($scope.total < empresaAux.consumacao_minima){
                    $ionicPopup.alert({
                        title: 'Informação',
                        template: '<center>Consumação mímina obrigatória!</center>'
                    });
                    $scope.consumacao_minima = empresaAux.consumacao_minima;
                }
            };

            $scope.openListProdutos = function () {
                $state.go('cliente.view_produtos');
            };

            $scope.openConfirmation = function () {
                var qtdMeiaB = $localStorage.get('qtdMeiaB');
                var qtdMeiaP = $localStorage.get('qtdMeiaP');
                var qtdMeiaM = $localStorage.get('qtdMeiaM');
                var qtdMeiaG = $localStorage.get('qtdMeiaG');
                if((qtdMeiaB%2 == 0)){
                    if((qtdMeiaP%2 == 0)){
                        if((qtdMeiaM%2 == 0)){
                            if((qtdMeiaG%2 == 0)){
                                $state.go('cliente.checkout_confirmation');
                            }else{
                                $ionicPopup.alert({
                                    title: 'Ooops!',
                                    template: '<center>Alguma pizza Grande está faltando a metade!</center>'
                                });
                            }
                        }else{
                            $ionicPopup.alert({
                                title: 'Ooops!',
                                template: '<center>Alguma pizza Média está faltando a metade!</center>'
                            });
                        }
                    }else{
                        $ionicPopup.alert({
                            title: 'Ooops!',
                            template: '<center>Alguma pizza Pequena está faltando a metade!</center>'
                        });
                    }
                }else{
                    $ionicPopup.alert({
                        title: 'Ooops!',
                        template: '<center>Alguma pizza Broto está faltando a metade!</center>'
                    });
                }
            };

            $scope.openProdutoDetalhes = function (i) {
                $localStorage.set('produto_index', i);
                $state.go('cliente.checkout_item_detalhes');
            };

            $scope.readBarCode = function () {
                $cordovaBarcodeScanner.scan().then(function (barcodeData) {
                        getValorCupom(barcodeData.text);
                    }, function (error) {
                        $ionicPopup.alert({
                            title: 'Informação',
                            template: '<center>Não foi possível ler o QR-Code!<br>Tente novamente!</center>'
                        })
                    });
            };

            $scope.removeCupom = function () {
                $cart.removeCupom();
                $scope.cupom = $cart.get().cupom;
                $scope.total = $cart.getTotalFinal();
            };

            function getValorCupom(codigo) {
                $ionicLoading.show({
                    template: 'Carregando...'
                });

                Cupom.get({codigo: codigo}, function (data) {
                    $ionicLoading.hide();
                    if (data.data.empresa_id != empresaAux.id) {
                        $ionicPopup.alert({
                            title: 'Informação',
                            template: '<center>Cupom inválido!</center>'
                        })
                    } else {
                        $cart.setCupom(data.data.codigo, data.data.valor);
                        $scope.cupom = $cart.get().cupom;
                        $scope.total = $cart.getTotalFinal();
                    }
                }, function (responseError) {
                    $ionicLoading.hide();
                    $ionicPopup.alert({
                        title: 'Informação',
                        template: '<center>Cupom inválido!</center>'
                    })
                });
            }
        }]);