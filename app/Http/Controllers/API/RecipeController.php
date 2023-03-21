<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\RecipeController as BaseController;
use App\Models\Recipe;
use Validator;
use App\Http\Resources\ProductResource;
use Illuminate\Http\JsonResponse;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : JsonResponse
    {
        $recipe = Recipe::all();
    
        return $this->sendResponse(RecipeResource::collection($recipe), 'Recipes retrieved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : JsonResponse
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
            'prep_time' => 'required',
            'difficulty' => 'required',
            'vegetarian' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $recipe = Recipe::create($input);
   
        return $this->sendResponse(new RecipeResource($recipe), 'Recipes created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) : JsonResponse
    {
        $recipe = Recipe::find($id);
  
        if (is_null($recipes)) {
            return $this->sendError('Recipes not found.');
        }
   
        return $this->sendResponse(new RecipeResource($recipe), 'Recipes retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipe $recipe ) : JsonResponse
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
            'prep_time' => 'required',
            'difficulty' => 'required',
            'vegetarian' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $recipe->name = $input['name'];
        $recipe->prep_time = $input['detail'];
        $recipe->difficulty = $input['difficulty'];
        $recipe->vegetarian = $input['vegetarian'];
        $product->save();
   
        return $this->sendResponse(new RecipeResource($recipe), 'Recipe updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe ) : JsonResponse
    {
        $recipe->delete();
   
        return $this->sendResponse([], 'Recipe deleted successfully.');
    }
}
