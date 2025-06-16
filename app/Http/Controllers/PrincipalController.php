<?php

namespace App\Http\Controllers;

use App\Models\Breed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PrincipalController extends Controller
{
    public function index(Request $request){

        $response = Http::get('https://api.thedogapi.com/v1/images/search', [
            'limit' => 8,
            'size' => 'med'
        ]);

        $imagenes = collect($response->json())->take(8);

        $response = Http::get('https://api.thedogapi.com/v1/images/search', [
            'limit' => 1,
            'size' => 'med'
        ]);

        $img = $response->json()[0];
        
        $response = Http::get('https://api.thedogapi.com/v1/images/search', [
            'limit' => 4,
            'size' => 'med'
        ]);

        $imagenes2 = collect($response->json())->take(4);

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
    

        return view('index', ['razas' => $razas, 'imagenes' => $imagenes, 'img' => $img, 'imagenes2' => $imagenes2]);
    }

}