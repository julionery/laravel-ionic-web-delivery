angular.module('starter.controllers')
    .controller('LogoutCtrl', [
        '$scope', '$state', 'OAuthToken','$ionicHistory', 'UserData',
        function ($scope, $state, OAuthToken, $ionicHistory, UserData) {
            OAuthToken.removeToken();
            UserData.set(null);
            $ionicHistory.clearCache();
            $ionicHistory.clearHistory();
            $ionicHistory.nextViewOptions({
                disableBack: true,
                historyRoot: true
            });
            $state.go('login');
        }]);