<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Prize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrizesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //index
    protected function index()
    {
        $prizes = DB::table('prizes')->where('cnpj',Auth::user()->cnpj)->get();

        return view('prizes.list', ['prizes' => $prizes]);
    }

    protected function getPrizes(Request $request){
        $prizes = DB::table('prizes')->where('cnpj',Auth::user()->cnpj)->get();

        $counter = 0;

        
        foreach ($prizes as $prize ) {
            $response[] = [
                "id" => $prize->id,
                "nome" => $prize->name,
                "preço" => $prize->price,
            ];
        }

        return response()->json($response);
    }

    protected function getPrizesForCustomer(Request $request){
        $prizes = DB::table('prizes')->where('cnpj',$request->cnpj)->get();

        $counter = 0;

        
        foreach ($prizes as $prize ) {
            $response[] = [
                "id" => $prize->id,
                "nome" => $prize->name,
                "preço" => $prize->price,
            ];
        }

        return response()->json($response);
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
        $prize = Prize::create([
            
            'name' => $request['name'],
            'cnpj' => Auth::user()->cnpj,
            'price' => $request['price'],
        ]);


        $prizes = DB::table('prizes')->where('cnpj',Auth::user()->cnpj)->get();
        return view('prizes.list', ['prizes' => $prizes]);
    }
}