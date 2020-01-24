angular.module('starter.services')
    .factory('Empresa', ['$resource', 'appConfig', function ($resource, appConfig) {
        return $resource(appConfig.baseUrl+ '/api/cliente/empresas', {}, {
            query: {
                isArray:false
            }
        });
    }]);