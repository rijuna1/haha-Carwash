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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = TypeCar::find($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        TypeCar::findOrFail($id)->delete();
      
        return response()->json(['message'=>'Type Car deleted successfully.']);
    }
}
