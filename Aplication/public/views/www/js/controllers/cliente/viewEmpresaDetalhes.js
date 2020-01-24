angular.module('starter.controllers')
    .controller('ClienteViewEmpresaDetalhesCtrl', [
        '$scope', '$state', '$EmpresaInfo',
        function ($scope, $state, $EmpresaInfo) {

            $scope.empresa = $EmpresaInfo.get();

            $scope.openListEmpresas = function () {
                $state.go('cliente.view_empresas');
            };
        }]);
