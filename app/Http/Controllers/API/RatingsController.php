<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Rate;
use Illuminate\Http\Request;

class RatingsController extends Controller
{
    public function store(Request $request)
{
  $request->validate([
    'recipe_id' => 'required|max:255',
    'ratings' => 'required'
  ]);

  $rating = new Rate([
    'recipe_id' => $request->get('recipe_id'),
    'ratings' => $request->get('ratings')
  ]);

  $rating->save();

  return response()->json($rating);
}
}
