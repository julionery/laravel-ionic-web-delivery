angular.module('starter.controllers')
    .controller('ClienteViewEmpresaDetalhesCtrl', [
        '$scope', '$state', '$EmpresaInfo',
        function ($scope, $state, $EmpresaInfo) {

            $scope.empresa = $EmpresaInfo.get();

            $scope.openListEmpresas = function () {
                $state.go('cliente.view_empresas');
            };

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
            
        }]);
