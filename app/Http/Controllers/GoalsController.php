<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoalsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //index
    protected function index()
    {
        $goals = DB::table('goals')->where('cnpj',Auth::user()->cnpj)->get();

        return view('goals.evento_list', ['goals' => $goals]);
    }

    //create
    
    protected function create(){

        $achieves = DB::table('rules_to_achieves')->where('cnpj',Auth::user()->cnpj)->get();

        $restricts = DB::table('rules_to_restricts')->where('cnpj',Auth::user()->cnpj)->get();

        $awards = DB::table('rules_to_awards')->where('cnpj',Auth::user()->cnpj)->get();

        return view('goals.evento_cadastro',[
            'awards' => $awards,
            'achieves' => $achieves,
            'restricts' => $restricts,
        ]);
    }
    
    //store
    protected function store(Request $request)
    {

        return view('goals.evento_list', ['goals' => $this->storeGoal($request)]);
    }

    protected function getGoals(){
        $goals = DB::table('goals')->where('cnpj',Auth::user()->cnpj)->get();

        return response()->json(['goals' => $goals]);
    }

    protected function storeGoal(Request $request){
        $cnpj = Auth::user()->cnpj;
        $name = $request["name"];


        $goal = Goal::create([
            'name' => $name,
            'cnpj' => Auth::user()->cnpj,
            'idRuleToAchieve' => $request['idRuleToAchieve'],
            'idRuleToRestrict' => $request['idRuleToRestrict'],
            'idRuleToAward' => $request['idRuleToAward'],
        ]);

        $customers = DB::table('customers')->where('cnpj',Auth::user()->cnpj)->get();
        
        foreach ($customers as $customer) {
            DB::table('customer_goals')->insert([
                'idGoals' => $goal->id,
                'idCustomers' => $customer->id,
                'cnpj' => $cnpj,
                'amountRestrict' => 0,
                'amountStored' => 0,
                'created_at' => '2015-01-01',
                'updated_at' => '2015-01-01',
            ]);
        }

        $goals = DB::table('goals')->where('cnpj',Auth::user()->cnpj)->get();

        return $goals;
    }
    
    //show
    /*
    protected function show($id)
    {
        $members = Goal::find($id);
        return view('goals.show',compact('members'));
    }
    //edit
    public function edit($id)
    {
        $members = Goal::find($id);
        return view('goals.edit',compact('members'));
    }

    //update
    public function update(Request $request, $id)
    {
        Goal::find($id)->update($request->all());
        return redirect()->route('goals.index')
                        ->with('success','goals updated successfully');
    }
    */
    //destroy
    /*
    protected function destroy($id)
    {
        Goal::find($id)->delete();
        return redirect()->
        route('goals.index')->
        with('success','goals deleted successfully');
    }
    */
}
