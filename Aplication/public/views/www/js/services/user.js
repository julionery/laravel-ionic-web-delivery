angular.module('starter.services')
    .factory('User', ['$resource', 'appConfig', function ($resource, appConfig) {
        return $resource(appConfig.baseUrl + '/api/authenticated', {}, {
            query: {
                isArray: false
            },
            authenticated: {
                method: 'GET',
                url: appConfig.baseUrl + '/api/authenticated'
            },
            updateDeviceToken: {
                method: 'PATCH',
                url: appConfig.baseUrl + '/api/device_token'
            }
        });
    }]);