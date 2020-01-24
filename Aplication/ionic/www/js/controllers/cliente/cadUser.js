angular.module('starter.controllers')
    .controller('ClienteCadUserCtrl', [
        '$scope', '$state', '$ionicLoading', 'ClienteCadUser', '$ionicPopup',
        function ($scope, $state, $ionicLoading, ClienteCadUser, $ionicPopup) {
            $scope.user = {
                nome: '',
                senha: '',
                confirmSenha: '',
                telefone: '',
                endereco: '',
                cep: '',
                bairro: ''
            };
            $scope.save = function () {

                if($scope.user.senha == $scope.user.confirmSenha){
                    $scope.user.nome = $scope.user.senha;
                }else{
                    $ionicPopup.alert({
                        title: 'Informação',
                        template: '<center>Senha e confirmação diferentes!</center>'
                    });
                }

                var o = $scope.user;

               $ionicLoading.show({
                        template: "Carregando..."
                    });

                ClienteCadUser.save({id: null}, o, function (data) {
                        $ionicLoading.hide();
                        $ionicPopup.alert({
                            title: 'Informação',
                            template: '<center>Cadastro realizado com sucesso!</center>'
                        });
                        $state.go('login');
                    }, function (responseError) {
                        $ionicLoading.hide();
                        $ionicPopup.alert({
                            title: 'Informação',
                            template: '<center>Falha ao cadastrar!<br>Tente novamente!</center>'
                        });
                    });
            }
        }]);