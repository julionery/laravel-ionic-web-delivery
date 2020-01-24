angular.module('starter.services')
    .factory('Categoria', ['$resource', 'appConfig', function ($resource, appConfig) {
        return $resource(appConfig.baseUrl+ '/api/cliente/categorias/:empresa_id', {empresa_id: '@empresa_id'}, {
            query: {
                isArray:false
            }
        });
    }]);