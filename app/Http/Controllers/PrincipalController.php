<?php

namespace App\Http\Controllers;

use App\Models\Breed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PrincipalController extends Controller
{
    public function index(Request $request){
        $filter = $request->input('filter', 'name');
        $query = $request->input('query', '');
    
        $razas = Breed::whereNotIn('id', [15, 90, 137]);
    
        if ($query !== '') {
            if ($filter == 'name') {
                $razas = $razas->where('name', 'like', "%{$query}%");
            } elseif ($filter == 'breed_group') {
                $razas = $razas->where('breed_group', 'like', "%{$query}%");
            }
        }
    
        $razas = $razas->paginate(12)->appends([
            'filter' => $filter,
            'query' => $query
        ]);
    
        return view('index', ['razas' => $razas]);
    }

}