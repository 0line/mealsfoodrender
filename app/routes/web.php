<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->group(
    ['prefix' => 'api/v1'],
    function () use ($router) {
        $router->group(['prefix' => 'healthcheck'], function () use ($router) {

            $router->get('/', function () use ($router) {
                return "Estoy trabajando!";
            });
        });

        $router->group(
            ['prefix' => 'meals'],
            function () use ($router) {
                $router->get(
                    '/',
                    [
                        'uses' => 'MealsController@getMeals'
                    ]
                );
            }
        );

        $router->group(
            ['prefix' => 'ingredients'],
            function () use ($router) {
                $router->get(
                    '/',
                    [
                        'uses' => 'IngredientsController@getIngredients'
                    ]
                );
                $router->get(
                    '/historypurchase',
                    [
                        'uses' => 'IngredientsController@getHistoryPurchase'
                    ]
                );
            }
        );

        $router->group(
            ['prefix' => 'order'],
            function () use ($router) {
                $router->post(
                    '/',
                    [
                        'uses' => 'OrdersController@createOrder'
                    ]
                );
                $router->get(
                    '/',
                    [
                        'uses' => 'OrdersController@getOrders'
                    ]
                );
            }
        );
    }
);
