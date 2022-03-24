<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use http\Client;
use Yajra\DataTables\DataTables;

class SalesController extends Controller
{
    public function index(){
        
    }

    public function create(){
        return view('sales.create');
    }

    public function store(Request $request){
        $input = $request->all();
    }
}
