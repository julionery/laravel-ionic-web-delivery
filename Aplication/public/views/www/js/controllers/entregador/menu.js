angular.module('starter.controllers')
    .controller('EntregadorMenuCtrl', [
        '$scope', '$state', 'UserData',
        function ($scope, $state, UserData) {
            $scope.usuario = UserData.get();
        }]);