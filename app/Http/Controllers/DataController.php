<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index()
    {
        $v1 = Movie::all();
        return response()->json($v1);
    }
    public function show($id)
    {
        $v1 = Movie::find($id);
        if ($v1) {
            return response()->json(['v1'=>$v1]);
        } else {
            return response()->json(['message'=>'No Records Found'], 404);
        }
    }
}
