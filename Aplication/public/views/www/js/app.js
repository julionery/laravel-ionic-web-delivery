// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
angular.module('starter.controllers', []);
angular.module('starter.services', []);
angular.module('starter.filters', []);

angular.module('starter', [
    'ionic', 'ionic.service.core','starter.controllers', 'starter.services', 'starter.filters',
    'angular-oauth2', 'ngResource', 'ngCordova', 'uiGmapgoogle-maps', 'pusher-angular'
    ])

    .constant('appConfig', {
        baseUrl: 'http://julionery.ddns.net:8000',
        pusherKey: "573135bfe442731f513b",
        redirectAfterLogin: {
            cliente: 'cliente.pedido',
            entregador: 'entregador.pedido'
        }
        
    })


    .run(function ($ionicPlatform, $window, appConfig, $localStorage) {
        $window.cliente = new Pusher(appConfig.pusherKey);
        $ionicPlatform.ready(function () {
            if (window.cordova && window.cordova.plugins.Keyboard) {
                // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
                // for form inputs)
                cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);

                // Don't remove this line unless you know what you are doing. It stops the viewport
                // from snapping when text inputs are focused. Ionic handles this internally for
                // a much nicer keyboard experience.
                cordova.plugins.Keyboard.disableScroll(true);
            }
            if (window.StatusBar) {
                StatusBar.styleDefault();
            }
            Ionic.io();
            var push = new Ionic.Push({
                debug: true,
                onNotification: function (menssage) {
                    alert(menssage.text);
                },
                pluginConfig:{
                    android: {
                       
                    }
                }
            });
            push.register(function (token) {
                $localStorage.set('device_token', token.token);
            })
        });
    })

    .config(function ($stateProvider, $urlRouterProvider, OAuthProvider, OAuthTokenProvider, appConfig, $provide) {

        OAuthProvider.configure({
            baseUrl: appConfig.baseUrl,
            clientId: 'appid01',
            clientSecret: 'secret', // optional
            grantPath: '/oauth/access_token'
        });

        OAuthTokenProvider.configure({
            name: 'token',
            options: {
                secure: false
            }
        });

        $stateProvider
            .state('login', {
                cache: false,
                url: '/login',
                templateUrl: 'templates/login.html',
                controller: 'LoginCtrl'
            })
            .state('logout', {
                url: '/logout',
                controller: 'LogoutCtrl'
            })
            .state('cad_user', {
                url: '/cad_user',
                templateUrl: 'templates/cliente/cad_user.html',
                controller: 'ClienteCadUserCtrl'
            })
            .state('home', {
                url: '/home',
                templateUrl: 'templates/home.html',
                controller: function ($scope) {
                }
            })
            .state('cliente', {
                abstract: true,
                cache: false,
                url: '/cliente',
                templateUrl: 'templates/cliente/menu.html',
                controller: 'ClienteMenuCtrl'
            })
            .state('cliente.pedido', {
                url: '/pedido',
                templateUrl: 'templates/cliente/pedido.html',
                controller: 'ClientePedidoCtrl'
            })
            .state('cliente.view_pedido', {
                url: '/view_pedido/:id',
                templateUrl: 'templates/cliente/view_pedidos.html',
                controller: 'ClienteViewPedidoCtrl'
            })
            .state('cliente.view_entrega', {
                cache: false,
                url: '/view_entrega/:id',
                templateUrl: 'templates/cliente/view_entrega.html',
                controller: 'ClienteViewEntregaCtrl'
            })
            .state('cliente.checkout', {
                cache: false,
                url: '/checkout',
                templateUrl: 'templates/cliente/checkout.html',
                controller: 'ClienteCheckoutCtrl'
            })
            .state('cliente.checkout_item_detalhes', {
                cache: false,
                url: '/checkout/detalhes/:index',
                templateUrl: 'templates/cliente/checkout_item_detalhes.html',
                controller: 'ClienteCheckoutDetalhesCtrl'
            })
            .state('cliente.checkout_confirmation', {
                cache: false,
                url: '/checkout/confirmation',
                templateUrl: 'templates/cliente/checkout_confirmation.html',
                controller: 'ClienteCheckoutConfirmationCtrl'
            })
            .state('cliente.checkout_successful', {
                cache: false,
                url: '/checkout/successful',
                templateUrl: 'templates/cliente/checkout_successful.html',
                controller: 'ClienteCheckoutSuccessfulCtrl'
            })
            .state('cliente.view_empresas', {
                cache: false,
                url: '/view_empresas',
                templateUrl: 'templates/cliente/view_empresas.html',
                controller: 'ClienteViewEmpresaCtrl'
            })
            .state('cliente.view_empresas_detalhes', {
                cache: false,
                url: '/view_empresas_detalhes',
                templateUrl: 'templates/cliente/view_empresas_detalhes.html',
                controller: 'ClienteViewEmpresaDetalhesCtrl'
            })
            .state('cliente.view_produtos', {
                cache: false,
                url: '/view_produtos',
                templateUrl: 'templates/cliente/view_produtos.html',
                controller: 'ClienteViewProdutoCtrl'
            })
            .state('cliente.view_categorias', {
                cache: false,
                url: '/view_categorias',
                templateUrl: 'templates/cliente/view_categorias.html',
                controller: 'ClienteViewCategoriaCtrl'
            })
            .state('cliente.view_adicionais', {
                cache: false,
                url: '/view_adicionais',
                templateUrl: 'templates/cliente/view_adicionais.html',
                controller: 'ClienteViewAdicionalCtrl'
            })
            .state('cliente.view_remove', {
                cache: false,
                url: '/view_remove',
                templateUrl: 'templates/cliente/view_remove.html',
                controller: 'ClienteViewRemoveCtrl'
            })
            .state('entregador', {
                abstract: true,
                cache: false,
                url: '/entregador',
                templateUrl: 'templates/entregador/menu.html',
                controller: 'EntregadorMenuCtrl'
            })
            .state('entregador.pedido', {
                url: '/pedido',
                templateUrl: 'templates/entregador/pedido.html',
                controller: 'EntregadorPedidoCtrl'
            })
            .state('entregador.view_pedido', {
                url: '/view_pedido/:id',
                templateUrl: 'templates/entregador/view_pedidos.html',
                controller: 'EntregadorViewPedidoCtrl'
            })
        ;
        $urlRouterProvider.otherwise('/login');  // => para retornar para esta rota caso o usuário tenha tentado acessar algo que não existe

        $provide.decorator('OAuthToken', ['$localStorage', '$delegate', function ($localStorage, $delegate) {
            Object.defineProperties($delegate, {
                setToken: {
                    value: function (data) {
                        return $localStorage.setObject('token', data);
                    },
                    enumerable: true,
                    configurable: true,
                    writable: true
                },
                getToken: {
                    value: function () {
                        return $localStorage.getObject('token');
                    },
                    enumerable: true,
                    configurable: true,
                    writable: true
                },
                removeToken: {
                    value: function () {
                        $localStorage.setObject('token', null);
                    },
                    enumerable: true,
                    configurable: true,
                    writable: true
                }
            });
            return $delegate;
        }]);
    });