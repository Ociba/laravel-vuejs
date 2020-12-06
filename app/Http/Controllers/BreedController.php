<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Breed;

class BreedController extends Controller
{
    //
    public function getBreedPage(){
        return view('breed');
    }
    protected function createBreed(){
        $breed =new Breed;
        $breed->breed =request()->breed;
        $breed->save();
        return 'ok';
    }
    protected function getBreed(){
        $breed =Breed::paginate(10);
        return response()->json($breed);
    }
    protected function editBreed($id){
        $breed =Breed::find($id);
        return response()->json($breed);
    }
    protected function updateBreed(){
        $breed =Breed::find(request()->id);
        $breed->breed =request()->breed;
        $breed->update();
        return 'ok';
    }
    protected function deleteBreed($id){
        $breed =Breed::find($id)->delete();
        return 'ok';
    }
}
