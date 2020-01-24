angular.module('starter.services')
    .factory('ClienteCadUser', ['$resource', 'appConfig', function ($resource, appConfig) {
        return $resource(appConfig.baseUrl + '/api/cad/:id', {id: '@id'}, {
            query: {
                isArray: false
            },
            create: {
                method: 'PATCH',
                url: appConfig.baseUrl + '/api/cad'
            }
        });
    }]);