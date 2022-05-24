<?php

namespace App\Http\Controllers;

use App\Models\Ingredients;
use App\Models\PurchaseHistory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IngredientsController extends ApiController
{
    /**
     * TODO: get all ingredients
     */
    public function getIngredients()
    {
        return $this->successResponse(Ingredients::all(), 'Listado de ingredientes', Response::HTTP_OK);
    }


    // TODO: update qty ingredient
    public function buyIngredient(string $ingredient, int $id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://recruitment.alegra.com/api/farmers-market/buy?ingredient=tomato',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 20,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response, true);
        Log::info($response);
        if (!empty($response) && isset($response['quantitySold']) && $response['quantitySold'] > 0) {
            DB::transaction(function () use ($response, $id) {
                $ingredient = Ingredients::findOrFail($id);;
                $ingredient->qty = $response['quantitySold'];
                $ingredient->save();
                $phistory = new PurchaseHistory();
                $phistory->fk_ingredient_id = $id;
                $phistory->qty = $response['quantitySold'];
                $phistory->save();
            });
            return $response['quantitySold'];
        } else {
            return 0;
        }
    }

    public function updateIngredient(int $id, int $qty)
    {
        DB::transaction(function () use ($id, $qty) {
            $ingredient = Ingredients::findOrFail($id);
            $ingredient->qty = $qty;
            $ingredient->save();
        });
    }

    public function getHistoryPurchase()
    {
        $phistory = PurchaseHistory::select('purchase_history.id', 'ingredients.ingredient', 'purchase_history.qty', 'purchase_history.created_at')
            ->leftJoin('ingredients', 'ingredients.id', '=', 'purchase_history.fk_ingredient_id')
            ->get();
        return $this->successResponse($phistory, 'Listado de ingredientes', Response::HTTP_OK);
    }
}
