<?php

namespace App\Http\Controllers;

use App\DataTables\TransactionDataTable;
use App\Models\Transaction;
use App\Models\TypeCar;
use App\Models\TypeWash;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\PrintConnectors\BluetoothPrintConnector;
use Mike42\Escpos\Printer;
use Exception;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, TransactionDataTable $datatable)
    {
        if ($request->ajax()) {
            return $datatable->data();
        }

        return view("transaction.index");
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
            'name' => 'required|min:3|max:50',
            'type_car' => 'required',
            'merk_car' => 'required',
            'plat' => 'required',
            'type_wash' => 'required',
            'information' => 'required',
            'additional_discount' => 'required|numeric',
        ]);

        $car = TypeCar::find($request->type_car);
        $wash = TypeWash::find($request->type_wash);

        $discount = $car->price * $wash->discount / 100;
        $total_price = $car->price - $discount - $request->additional_discount;

        if($request->id){
            $no_trans = Transaction::find($request->id)->no_trans;
        }else{
            $no_trans = strtolower(str_replace(' ', '', $request->plat)).'_'.date('YmdHis');
        }

        $data = Transaction::updateOrCreate([
            'id' => $request->id,
        ],
        [
            'no_trans' => $no_trans,
            'name' => $request->name, 
            'type_car' => $request->type_car,
            'merk_car' => $request->merk_car,
            'plat' => $request->plat,
            'type_wash' => $request->type_wash,
            'information' => $request->information,
            'price' => $car->price,
            'discount' => $discount,
            'additional_discount' => $request->additional_discount,
            'total_price' => $total_price,
            'user_in' => Auth::user()->username,
        ]); 

        return response()->json(['message'=>'Transaction saved successfully.', 'data' => $data]);
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
        $transaction = Transaction::join('type_cars', 'type_cars.id', '=', 'transactions.type_car')
                    ->join('type_washes', 'type_washes.id', '=', 'transactions.type_wash')
                    ->where('transactions.id', $id)
                    ->select('transactions.*', 'type_cars.type_car as car', 'type_washes.type_wash as wash')
                    ->first();
        return response()->json($transaction);
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
        Transaction::findOrFail($id)->delete();
      
        return response()->json(['message'=>'Transaction deleted successfully.']);
    }

    public function print(string $id)
    {
        $data = Transaction::find($id);   
        $title = date('YmdHis');
        $qrcode = QrCode::size(200)->generate($data->no_trans);
        $name = $data->name;
        $plat = $data->plat;
        $total_price = $data->total_price;


        $pdf = PDF::loadView('transaction/struk', compact('title','qrcode', 'name', 'plat', 'total_price'));

        $response = response($pdf->output());
        $response->header('Content-Type', 'application/pdf');
        $response->header('Content-Disposition', 'inline; filename='.date('YmdHis').'.pdf');
        return $response;

        // return $pdf->stream('dokumen.pdf');
    }

    public function viewScan(string $no_trans)
    {
        $transaction = Transaction::where('no_trans', $no_trans)
        ->first();

        return response()->json($transaction);
    }

    public function scan(Request $request)
    {
        $transaction = Transaction::where('id', $request->id)
                        ->where('user_out', NULL)
                        ->first();
        
        if($transaction){
            $transaction->update([
                'user_out' => Auth::user()->username
            ]);
        
            return response()->json(['message'=>'Scanner QR Code successfully.']);
        }else{
            return response()->json(['error'=>'Scanner QR Code Failed.']);
        }
       
    }
}
