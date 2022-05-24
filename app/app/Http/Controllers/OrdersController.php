<?php

namespace App\Http\Controllers;

use App\Models\OrderMeals;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Meals;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Controllers\IngredientsController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class OrdersController extends ApiController
{
    private $readymeals = [];
    private $current_meal;
    private $current_ingredient;
    private $oingredients;

    public function __construct()
    {
        $this->oingredients = new IngredientsController();
    }
    public function createOrder(Request $request)
    {
        //Recibir array de id de platillos y cantidad
        $rules = [
            'qty' => ['required', 'integer', 'min:1']
        ];
        //Validar request
        $this->validate($request, $rules);

        //?Obtener platillos random
        $meals = Meals::with('ingredients')->get()->random($request->qty);

        $adetail = [];
        //Guardar en el historial de ordenes
        foreach ($meals as $key => $meal) {
            $adetail[] = new OrderMeals(['fk_meal_id' => $meal['id'], 'qty' => 1]);
        }
        DB::transaction(function () use ($adetail) {
            $order = new Orders();
            $order->save();
            $orderMeal = Orders::find($order->id);
            $orderMeal->orderdetail()->saveMany($adetail);
        });
        //Solo retornar los platillos que se pudieron realizar.
        $meals = json_decode(json_encode($meals, true), true);
        $this->createMeal($meals);
        if (count($this->readymeals) == 0) {
            return $this->errorResponse('Lo sentimos ya no hay ingredientes para preparar platillos', Response::HTTP_BAD_REQUEST);
        }
        if (count($this->readymeals) == $request->qty) {
            return $this->successResponse('', 'Se puediron preparar todos tus platillos', Response::HTTP_OK);
        } else {
            return $this->successResponse(
                '',
                'Solo se puediron preparar '
                    . count($this->readymeals) . ' de tus ' . $request->qty . 'platillos',
                Response::HTTP_OK
            );
        }
    }



    public function createMeal(array $meals)
    {

        //Validar que existan los ingredientes para elaborar cada platillo.
        foreach ($meals as $keymeal => $meal) {
            Log::info($meal);
            if ((!isset($this->current_meal)) && ($this->current_meal > $keymeal)) {
                next($meals);
            }
            foreach ($meal['ingredients'] as $keyingredient => $ingredient) {
                if ((!isset($this->current_ingredient)) && ($this->current_ingredient > $keyingredient)) {
                    next($meal);
                }
                Log::info($ingredient);
                Log::info([
                    'current' => $this->current_meal, "key" => $keymeal,
                    'currentingredient' => $this->current_ingredient, "key" => $keyingredient,
                    "result" => (($this->current_meal != $keymeal) || (!isset($this->current_meal)))
                ]);
                if (($ingredient['qty'] > 0) &&
                    ($ingredient['qty']
                        >= $ingredient['pivot']['qty_ingredient'])
                ) {
                    $this->readymeals[$meal['id']][] = $ingredient['id'];
                    Log::info([
                        'bodega' => $ingredient['qty'],
                        'platillo' => $ingredient['pivot']['qty_ingredient'],
                        'total' => ($ingredient['qty'] - $ingredient['pivot']['qty_ingredient'])
                    ]);
                    $this->oingredients->updateIngredient($ingredient['id'], ($ingredient['qty'] - $ingredient['pivot']['qty_ingredient']));
                } elseif (($this->current_meal != $keymeal) || (!isset($this->current_meal))) {
                    Log::info("Comprando ingrediente:" . $ingredient['ingredient']);
                    //Si no existe la cantidad mandar a comprar los ingredientes
                    $result = $this->oingredients->buyIngredient($ingredient['ingredient'], $ingredient['id']);
                    if ($result != 0) {
                        $meals[$keymeal]['ingredients'][$keyingredient]['qty'] = $result;
                        Log::info($meals);
                        $this->current_meal = $keymeal;
                        $this->current_ingredient = $keyingredient;
                        $this->createMeal($meals);
                    } else {
                        break;
                    }
                } else {
                    Log::info("romper-ciclo");
                    break;
                }
            }
        }
    }

    public function getOrders()
    {
        $order = Orders::select('orders.id', 'meals.title_food')
            ->leftJoin('ordermeals', 'orders.id', '=', 'ordermeals.fk_order')
            ->leftJoin('meals', 'ordermeals.fk_meal_id', '=', 'meals.id')
            ->get();
        $listorders = [];
        foreach ($order as $key => $value) {
            $listorders[$value['id']][] = $value['title_food'];
        }
        /* foreach ($order as $key => $value) {
            $listorders[$value['id']]['orden'] = $value['id'];
            $listorders[$value['id']]['platillos'][]
            = $value['title_food'];
        } */
        return $this->successResponse($listorders, 'Listado de ordenes', Response::HTTP_OK);
    }
}
