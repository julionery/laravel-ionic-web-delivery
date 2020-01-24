angular.module('starter.controllers')
    .controller('ClienteViewEmpresaCtrl', [
        '$scope', '$state', 'Empresa', '$ionicLoading', '$EmpresaInfo', '$localStorage', '$cart', '$ionicPopup', '$window', '$timeout',
        function ($scope, $state, Empresa, $ionicLoading, $EmpresaInfo, $localStorage, $cart, $ionicPopup, $window, $timeout) {
            $scope.empresas = [];
            $scope.status = 0;

            if ($cart.get().items != '') {
                var confirmPopup = $ionicPopup.confirm({
                    title: 'Atenção - Pedido',
                    template: 'Existem itens pendentes no pedido!<br><br>Deseja continuar pedido?'
                });
                confirmPopup.then(function (resposta) {
                    if (resposta) {
                        $state.go('cliente.checkout');
                    } else {
                        $EmpresaInfo.esvaziarEmpresa();
                        $cart.esvaziarCarrinho();
                    }
                });
            }

            $ionicLoading.show({
                template: "Carregando..."
            });

            Empresa.query({}, function (data) {
                $scope.empresas = data.data;
                $ionicLoading.hide();
            }, function (dataError) {
                $ionicLoading.hide();
                $state.go('login');
            });

            $scope.openEmpresaDetalhes = function (empresa) {
                setEmpresaStorage(empresa);
                $state.go('cliente.view_empresas_detalhes');
            };

            $scope.openCategorias = function (empresa) {

                var status = $scope.statusEmpresa(empresa);

                if (status == 0) {
                    $ionicPopup.alert({
                        title: 'Informação',
                        template: '<center>Loja fechada,<br>tente pelo telefone!</center>'
                    });
                } else if (status == 1) {
                        if ($cart.get().items != '') {
                            var confirmPopup = $ionicPopup.confirm({
                                title: 'Informação - Pedido',
                                template: 'Existem itens pendentes no pedido!<br><br>Deseja continuar pedido?'
                            });
                            confirmPopup.then(function (resposta) {
                                if (resposta) {
                                    $state.go('cliente.checkout');
                                } else {
                                    $cart.setEmpresa(empresa.id);
                                    $state.go('cliente.view_categorias', {empresa_id: empresa.id});
                                }
                            });
                        } else {
                            setEmpresaStorage(empresa);
                            $cart.setEmpresa(empresa.id);
                            $state.go('cliente.view_categorias', {empresa_id: empresa.id});
                        }
                    }
            };

            function setEmpresaStorage(empresa) {
                $EmpresaInfo.setEmpresaDetalhes(
                    empresa.id,
                    empresa.nome_fantasia,
                    empresa.telefone,
                    empresa.endereco,
                    empresa.bairro,
                    empresa.cidade,
                    empresa.estado,
                    empresa.cep,
                    empresa.consumacao_minima,
                    empresa.abertura,
                    empresa.fechamento,
                    empresa.status
                );
            }

            $scope.statusEmpresa = function (empresa) {
                var dataAtual = new Date();
                var horaAtual = dataAtual.getHours();
                var minutoAtual = dataAtual.getMinutes();
                var timeAtual = new Date(1970, 0, 1, horaAtual, minutoAtual);

                if (empresa.abertura) {
                    var horaAbertura = empresa.abertura.slice(0, 2);
                    var minAbertura = empresa.abertura.slice(3, 5);
                    var timeAbertura = new Date(1970, 0, 1, horaAbertura, minAbertura);
                }
                if (empresa.fechamento) {
                    var horaFechamento = empresa.fechamento.slice(0, 2);
                    var minFechamento = empresa.fechamento.slice(3, 5);
                    var timeFechamento = new Date(1970, 0, 1, horaFechamento, minFechamento);
                }
                if (empresa.status == 1) {
                    if ((timeAtual > timeAbertura && timeAtual < timeFechamento)) {
                        return 1;
                    } else {
                        return 0;
                    }
                } else {
                    return 0;
                }
            };

            $scope.doRefresh = function () {
                $timeout(function () {
                    $scope.$broadcast('scroll.refreshComplete');
                },200);
            };

        }]);
