<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Prize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrizesController extends Controller
{
    //index
    protected function index()
    {
        $prizes = DB::table('prizes')->where('cnpj',Auth::user()->cnpj)->get();

        return view('prizes.list', ['prizes' => $prizes]);
    }

    //create
    
    protected function create(){

        return view('prizes.prizes');
    }
    
    //store
    protected function store(Request $request)
    {
        $name = $request['name'];
        $cnpj = Auth::user()->cnpj;
        $id = md5("$name$cnpj");
        $prize = Prize::create([
            'id' => $id,
            'name' => $request['name'],
            'cnpj' => Auth::user()->cnpj,
            'price' => $request['price'],
        ]);


        $prizes = DB::table('prizes')->where('cnpj',Auth::user()->cnpj)->get();
        return view('prizes.list', ['prizes' => $prizes]);
    }
}