angular.module('starter.controllers')
    .controller('ClienteMenuCtrl', [
        '$scope', '$state', 'UserData',
        function ($scope, $state, UserData) {
            $scope.usuario = UserData.get();

            $scope.logout = function () {
                $state.go('logout');
            }
        }]);