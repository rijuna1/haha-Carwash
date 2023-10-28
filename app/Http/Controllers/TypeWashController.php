<?php

namespace App\Http\Controllers;

use App\DataTables\TypeWashDataTable;
use App\Models\TypeWash;
use Illuminate\Http\Request;

class TypeWashController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, TypeWashDataTable $datatable)
    {
        if ($request->ajax()) {
            return $datatable->data();
        }

        return view("typeWash.index");
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_wash' => 'required|min:3|max:50',
            'discount' => 'numeric|required',
        ]);

        TypeWash::updateOrCreate([
            'id' => $request->id
        ],
        [
            'type_wash' => $request->type_wash, 
            'discount' => $request->discount,
        ]);        

        return response()->json(['message'=>'Type Wash saved successfully.']);
    }

    public function edit(string $id)
    {
        $user = TypeWash::find($id);
        return response()->json($user);
    }

    public function destroy(string $id)
    {
        TypeWash::findOrFail($id)->delete();
      
        return response()->json(['message'=>'Type Wash deleted successfully.']);
    }

    public function getTypeWash()
    {
        $washes = TypeWash::pluck('type_wash', 'id')->map(function($type_wash, $id){
            $data_discount = TypeWash::find($id)->discount;
            return [
                'type_wash' => $type_wash,
                'discount' => $data_discount
            ];
        });

        return response()->json($washes);
    }
}
