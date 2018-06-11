<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Prize;
use App\LogPrize;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogsController extends Controller
{

    public function __construct()
    {
       $this->middleware('auth', ['except' => 'getPrizesForCustomer']);
    }
    
    //index
    protected function logPrize()
    {
        $logs = DB::table('log_prize')->get();

        return view('logs.log_premiacao', ['logs' => $logs]);
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
}