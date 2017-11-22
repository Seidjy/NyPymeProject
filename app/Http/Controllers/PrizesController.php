<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoalsController extends Controller
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
        $id = md5("$request['cnpj']"+"$request['name']");
        $prize = Prize::create([
            'id' => $id,
            'name' => $request['name'],
            'cnpj' => Auth::user()->cnpj,
            'price' => $request['price'],
        ]);


        $prizes = DB::table('prizes')->where('cnpj',Auth::user()->cnpj)->get();
        return view('prizes.evento_list', ['prizes' => $prizes]);
    }
}