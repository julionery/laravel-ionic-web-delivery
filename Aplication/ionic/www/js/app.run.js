angular.module('starter.run').run(['$state', 'PermissionStore', 'RoleStore', 'OAuth', 'UserData', '$rootScope', 'authService', 'httpBuffer',
    function ($state, PermissionStore, RoleStore, OAuth, UserData, $rootScope, authService, httpBuffer) {
        PermissionStore.definePermission('user-permission', function () {
            return OAuth.isAuthenticated();
        });

        /*
         * Permissões de cliente
         * */

        PermissionStore.definePermission('client-permission', function () {
            var user = UserData.get();
            if (user == null || !user.hasOwnProperty('tipo')) {
                return false;
            }
            return user.tipo == 'cliente';
        });
        RoleStore.defineRole('client-role', ['user-permission', 'client-permission']);

        /*
         * Permissões de cliente
         * */

        PermissionStore.definePermission('entregador-permission', function () {
            var user = UserData.get();
            if (user == null || !user.hasOwnProperty('tipo')) {
                return false;
            }
            return user.tipo == 'entregador';
        });
        RoleStore.defineRole('entregador-role', ['user-permission', 'entregador-permission']);

        $rootScope.$on('event:auth-loginRequired', function (event, data) {
            switch (data.data.error){
                case 'access_denied':
                    if (!$rootScope.refreshingToken) {
                        $rootScope.refreshingToken = OAuth.getRefreshToken();
                    }
                    $rootScope.refreshingToken.then(function (data) {
                        authService.loginConfirmed();
                        $rootScope.refreshingToken = null;
                    }, function (responseError) {
                        $state.go('logout');
                    });
                    break;
                case 'invalid_credentials':
                    httpBuffer.rejectAll(data);
                    break;
                default:
                    $state.go('logout');
            }
        });

    }]);