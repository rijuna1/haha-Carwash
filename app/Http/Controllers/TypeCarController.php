<?php

namespace App\Http\Controllers;

use App\DataTables\TypeCarDataTable;
use App\Models\TypeCar;
use Illuminate\Http\Request;

class TypeCarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, TypeCarDataTable $datatable)
    {
        if ($request->ajax()) {
            return $datatable->data();
        }

        return view("typeCar.index");
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_car' => 'required|min:3|max:50',
            'price' => 'numeric|required',
        ]);

        TypeCar::updateOrCreate([
            'id' => $request->id
        ],
        [
            'type_car' => $request->type_car, 
            'price' => $request->price,
        ]);        

        return response()->json(['message'=>'Type Car saved successfully.']);
    }

    public function edit(string $id)
    {
        $user = TypeCar::find($id);
        return response()->json($user);
    }

    public function destroy(string $id)
    {
        TypeCar::findOrFail($id)->delete();
      
        return response()->json(['message'=>'Type Car deleted successfully.']);
    }
}
