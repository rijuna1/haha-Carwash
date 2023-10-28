<?php

namespace App\DataTables;

use App\Models\Transaction;
use Yajra\DataTables\Facades\Datatables;

class TransactionDataTable
{
    public function data()
    {
        $data = Transaction::latest()->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editTransaction '.($row->user_out ? "disabled" : "").'">Edit</a>';
                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Print" class="btn btn-info btn-sm printTransaction '.($row->user_out ? "disabled" : "").'">Print</a>';
                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteTransaction '.($row->user_out ? "disabled" : "").'">Delete</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}