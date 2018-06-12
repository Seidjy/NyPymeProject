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

    protected function logLogin(Request $request){
        $logs = DB::table('log_login')->get();

        return view('logs.log_login', ['logs' => $logs]);
    }

    protected function logLoginSuccess(Request $request){
        $logs = DB::table('log_login')->where('action','Sucesso')->get();

        return view('logs.log_login', ['logs' => $logs]);
    }

    protected function logLoginNotSuccess(Request $request){
        $logs = DB::table('log_login')->where('action','Insucesso')->get();

        return view('logs.log_login', ['logs' => $logs]);
    }

    public function logParticipant(Request $request){
        $logs = DB::table('log_participant')->get();

        return view('logs.log_login', ['logs' => $logs]);
    }
}