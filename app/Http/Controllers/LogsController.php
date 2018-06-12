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

        $logs = $this->arrayFormatDate($logs);

        return view('logs.log_premiacao', ['logs' => $logs]);
    }

    protected function logLogin(Request $request){
        $logs = DB::table('log_login')->get();

        $logs = $this->arrayFormatDate($logs);

        return view('logs.log_login', ['logs' => $logs]);
    }

    protected function logLoginSuccess(Request $request){
        $logs = DB::table('log_login')->where('action','Sucesso')->get();

        $logs = $this->arrayFormatDate($logs);

        return view('logs.log_login', ['logs' => $logs]);
    }

    protected function logLoginNotSuccess(Request $request){
        $logs = DB::table('log_login')->where('action','Insucesso')->get();

        $logs = $this->arrayFormatDate($logs);

        return view('logs.log_login', ['logs' => $logs]);
    }

    public function logParticipant(Request $request){
        $logs = DB::table('log_participant')->get();

        $logs = $this->arrayFormatDate($logs);

        return view('logs.log_participant', ['logs' => $logs]);
    }

    public function logPrizeDate(Request $request){
        $first_date = new DateTime($request['first_date']);
        $last_date = new DateTime($request['last_date']);

        //dd($first_date->format('d-m-Y H:i'));

        $logs = DB::table('log_prize')
        ->where('created_at', '>=', $first_date)
        ->where('created_at', '<=', $last_date)
        ->get();

        $logs = $this->arrayFormatDate($logs);

        return view('logs.log_premiacao', ['logs' => $logs]);
    }

    public function logParticipantDate(Request $request){
        $logs = DB::table('log_participant')
        ->where('created_at', '>=', $first_date)
        ->where('created_at', '<=', $last_date)
        ->get();

        $logs = $this->arrayFormatDate($logs);

        return view('logs.log_participant', ['logs' => $logs]);
    }

    public function arrayFormatDate($array){
        foreach ($array as $key => $value) {
            $value->created_at = new DateTime($value->created_at);

            $array[$key]->created_at = $value->created_at->format('d-m-Y H:i');
        }

        return $array;
    }
}