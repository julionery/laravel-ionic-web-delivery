angular.module('starter.services')
    .factory('Adicional', ['$resource', 'appConfig', function ($resource, appConfig) {
        return $resource(appConfig.baseUrl+ '/api/cliente/adicionais/:empresa_id', {empresa_id: '@empresa_id'},  {
            query: {
                isArray:false
            }
        });
    }]);