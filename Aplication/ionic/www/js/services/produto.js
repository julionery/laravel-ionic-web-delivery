angular.module('starter.services')
    .factory('Produto', ['$resource', 'appConfig', function ($resource, appConfig) {
        return $resource(appConfig.baseUrl + '/api/cliente/produtos/:categoria_id', {categoria_id: '@categoria_id'}, {
            query: {
                isArray: false
            }
        });
    }]);