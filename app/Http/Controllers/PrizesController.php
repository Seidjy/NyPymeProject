<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Prize;
use App\LogPrize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrizesController extends Controller
{

    public function __construct()
    {
       $this->middleware('auth', ['except' => 'getPrizesForCustomer']);
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

    public function getPrizesForCustomer(Request $request){
        $prizes = DB::table('prizes')->where('cnpj',$request['cnpj'])->get();

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

    //edit
    public function edit($id)
    {
        $prize = Prize::find($id);

       return view('prizes.prizes_edit',[
            
            'prize' => $prize
        ]);
    }
    //update
       public function update(Request $request, $id)
    {
        $prize = Prize::find($id);

        $prize = LogPrize::create([
            'novo_nome' => $request['name'],
            'antigo_nome' => $prize->name,
            'novo_preco' => $request['price'],
            'antigo_preco' => $prize->price,
            'usuario' => Auth::user()->cnpj,
            'ip' => $request->ip(),
            'action' => "Update",
            'created_at' => new DateTime(@"$_SERVER->REQUEST_TIME"),
        ]);

        $prizes = Prize::find($id)->update($request->all());
        return redirect()->route('prizes.index');
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