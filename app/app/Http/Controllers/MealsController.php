<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meals;
use Illuminate\Http\Response;

class MealsController extends ApiController
{
    public function getMeals()
    {
        return $this->successResponse(Meals::with('ingredients')->get(), 'Listado de recetas', Response::HTTP_OK);
    }
}
