angular.module('starter.services')
    .factory('Cupom', ['$resource', 'appConfig', function ($resource, appConfig) {
        return $resource(appConfig.baseUrl+ '/api/cupom/:codigo', {codigo: '@codigo'}, {
            query: {
                isArray:false
            }
        });
    }]);