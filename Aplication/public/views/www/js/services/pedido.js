angular.module('starter.services')
    .factory('ClientePedido', ['$resource', 'appConfig', function ($resource, appConfig) {
        return $resource(appConfig.baseUrl + '/api/cliente/pedido/:id', {id: '@id'}, {
            query: {
                isArray: false
            }
        });
    }])
    .factory('EntregadorPedido', ['$resource', 'appConfig', function ($resource, appConfig) {
        var url = appConfig.baseUrl + '/api/entregador/pedido/:id';
        return $resource(url, {id: '@id'}, {
            query: {
                isArray: false
            },
            updateStatus: {
                method: 'PATCH',
                url: url + '/update-status'
            },
            geo: {
                method: 'POST',
                url: url + '/geo'
            }
        });
    }]);