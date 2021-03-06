<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Deal;
use App\Http\Controllers\CustomerController;
use App\Customer;
use App\LogParticipant;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\Auth;

//Transações

class DealsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $members = Deal::latest()->paginate(10);
        return view('deals.transacao_def',compact('members'));
    }

    protected function store(Request $data)
    {
        $this->storeDeals($data);
        
        return redirect()->route('customers.index');
    }

    protected function verifyDate(){

    }

    protected function storeDelasAPI(Request $request){
        $customer = $this->storeDeals($request);

        $counter = 0;
        foreach ($customer['customer'] as $client ) {
            $response[$counter] =  [
                "nome" => $client->name,
                "cpf" => $client->cpf,
                "cnpj" => $client->cnpj,
                "pontos" => $client->points,
                "pontosRecebidos" => $customer['atual']
            ];
        }

        return response()->json($response[0]);
    }

    protected function storeDeals(Request $data){
        $customer = $this->storeCustomer($data);

        $cpf = $customer->cpf;

        $cnpj = Auth::user()->cnpj;

        $customerPoints = $customer->points;

        $customerPointsNow = $customerPoints;

        $deal = Deal::create([
            'idCustomer' => $customer->id,
            'cnpj' => Auth::user()->cnpj,
            'idTypeTransactions' => 1,
            'amount' => $data->input('amount'),
            'updated_at' => $data->input('updated_at'),
            'created_at' => $data->input('created_at'),
        ]);

        $todays = new DateTime(@"$_SERVER->REQUEST_TIME");

        $customerGoals = DB::table('customer_goals')->where('idCustomers', $customer->id)->get();

        foreach ($customerGoals as $customerGoal) {
            $customerGoalsAmountRestrict = $customerGoal->amountRestrict;
            $customerGoalsAmountStored = 0;
            $goal = DB::table('goals')->where('id', $customerGoal->idGoals)->first();

            if ($this->goalsTimeRestriction($goal->id, $customerGoal)) {
                $idRuleToAchieve = $goal->idRuleToAchieve;

                $achieve = DB::table('rules_to_achieves')->where('id', $idRuleToAchieve)->first();
                $idTypeToAchieve = $achieve->idTypeAchieve;
                if ($idTypeToAchieve == 1) {
                    if ($achieve->gather) {
                        if (($data->input('amount') + $customerGoal->amountStored) >= $achieve->amount) {
                            $customerGoalsAmountRestrict = $customerGoal->amountRestrict + 1;
                            $awards = DB::table('rules_to_awards')
                                ->where('id', $goal->idRuleToAward)
                                ->first();

                            $customerPoints = $customerPoints + $awards->amount;

                            $participant = Customer::find($customer->id);

                            $logParticipant = LogParticipant::create([
                                'novo_cpf' => $cpf,
                                'antigo_cpf' => $cpf,
                                'nova_pontuacao' => $customerPoints,
                                'antiga_pontuacao' => $participant->points,
                                'usuario' => Auth::user()->cnpj,
                                'ip' => $data->ip(),
                                'action' => "Update Pontos",
                                'created_at' => new DateTime(@"$_SERVER->REQUEST_TIME"),
                            ]);

                            DB::table('customers')
                                ->where('id', $customer->id)
                                ->update(['points' => $customerPoints]);
                        }else{
                            $customerGoalsAmountStored = $data->input('amount');
                            $todays = $lastDate;
                        }
                            DB::table('customer_goals')
                                ->where('id', "$customerGoal->id")
                                ->update(['amountRestrict' => $customerGoalsAmountRestrict,
                                        'amountStored' => $customerGoalsAmountStored,
                                        'updated_at' => $todays,
                            ]);
                    }else{
                        if ($data->input('amount') >= $achieve->amount) {
                            $awards = DB::table('rules_to_awards')
                                ->where('id', $goal->idRuleToAward)
                                ->first();
                            $customerPoints = $customerPoints + $awards->amount;

                            $participant = DB::table('customers')->where([
                                ['cpf', $cpf],
                                ['cnpj', Auth::user()->cnpj],
                            ])->first();

                            $logParticipant = LogParticipant::create([
                                'novo_cpf' => $cpf,
                                'antigo_cpf' => $cpf,
                                'nova_pontuacao' => $customerPoints,
                                'antiga_pontuacao' => $participant->points,
                                'usuario' => Auth::user()->cnpj,
                                'ip' => $data->ip(),
                                'action' => "Update Pontos",
                                'created_at' => new DateTime(@"$_SERVER->REQUEST_TIME"),
                            ]);

                            $customer = DB::table('customers')
                                ->where('cpf', $cpf)
                                ->update(['points' =>  $customerPoints]);



                            $customerGoalsAmountRestrict = $customerGoal->amountRestrict + 1;
                            DB::table('customer_goals')
                                ->where('id', "$customerGoal->id")
                                ->update(['amountRestrict' => $customerGoalsAmountRestrict,
                                    'updated_at' => $todays,
                            ]);
                        }
                    }
                }
            }
        }
        $customers['customer'] = DB::table('customers')->where(['cnpj' => Auth::user()->cnpj, 'cpf' => $cpf])->get();
        $customers['atual'] = $customerPointsNow;
        return $customers;
    }

    protected function storeCustomer(Request $data){
        $cpf = $data->input('cpf');
        $customer = DB::table('customers')->where([
            ['cpf', $cpf],
            ['cnpj', Auth::user()->cnpj],
        ])->first();

        if (!$customer) {
            CustomerController::addCustomer($cpf, "");
            $customer = DB::table('customers')->where([
                ['cpf', $cpf],
                ['cnpj', Auth::user()->cnpj],
            ])->first();
        }

        return $customer;
        
    }

    protected function goalsTimeRestriction($id, $customerGoals){
        $goal = DB::table('goals')->where('id', $id)->first();
        $idRuleToRestrict = $goal->idRuleToRestrict;
        $ruleToRestrict = DB::table('rules_to_restricts')->where('id', $idRuleToRestrict)->first();

        $typeRestriction = DB::table('type_restricts')->where('id', $ruleToRestrict->idTypeRestrict)->first();

        if ($typeRestriction->name != "Dias") {
            return true;
        }

        $lastDate = new DateTime(@"$customerGoals->updated_at");

        $todays = new DateTime(@"$_SERVER->REQUEST_TIME");
                
        $restriction = $lastDate->diff($todays);
        $days = $restriction->format('%a');

        if ($days >= $ruleToRestrict->amount) {
            return true;
        }else{
            return false;
        }
    }

    //criar por valor
    protected function create()
    {
        return view('deals.transacao_def');
    }

    //criar por evento

    protected function createbyGoal()
    {
        $goals = DB::table('goals')->where('cnpj',Auth::user()->cnpj)->get();
        return view('deals.transacao_def_by_goal', ['goals' => $goals]);
    }
   /** ARRUMAR **/
    protected function storeByGoal(Request $request){
        $customer = $this->storeCustomer($request);
        $customerPoints = $customer->points;

        $deal = Deal::create([
            'idCustomer' => $customer->id,
            'cnpj' => Auth::user()->cnpj,
            'idTypeTransactions' => 1,
            'idGoals' => $request['idGoals'],
            'updated_at' => $request->input('updated_at'),
            'created_at' => $request->input('created_at'),
        ]);

        $customerGoals = DB::table('customer_goals')->where([['idCustomers', $customer->id],['idGoals', $request['idGoals'],['cnpj', Auth::user()->cnpj],]])->first();
        $goal = DB::table('goals')->where('id', $request['idGoals'])->first();

        
        if ($this->goalsTimeRestriction($request['idGoals'],$customerGoals)) {
            $award = DB::table('rules_to_awards')->where('id', $goal->idRuleToAward)->first();

            $customerPoints += $award->amount;

            DB::table('customers')
                ->where('id', $customer->id)
                ->update(['points' => $customerPoints]);
            $todays = new DateTime(@"$_SERVER->REQUEST_TIME");
            DB::table('customer_goals')
                                ->where('id', "$customerGoals->id")
                                ->update(['amountRestrict' => $customerGoals->amountRestrict++,
                                        'updated_at' => $todays,
                                ]);
        }

        return redirect()->route('customers.index');
    }

    protected function debit(){
        $prizes = DB::table('prizes')->where('cnpj',Auth::user()->cnpj)->get();
        return view('deals.transacao_def_debito', ['prizes' => $prizes]);
    }

    protected function storeDebitAPI(Request $request){
        $customer = $this->makeDebit($request);


        $counter = 0;
        foreach ($customer as $client ) {
            $response[$counter] =  [
                "nome" => $client->name,
                "cpf" => $client->cpf,
                "cnpj" => $client->cnpj,
                "pontos" => $client->points
                //"pontosRecebidos" => $customer['atual']
            ];
        }

        return response()->json($response[0]);

    }

    protected function makeDebit(Request $request){
        $customer = $this->storeCustomer($request);
        $customerPoints = $customer->points;

        $prize = DB::table('prizes')->where([['cnpj' , Auth::user()->cnpj],['id' , $request['idPrize']]])->first();

        foreach ($prize as $priz) {
            $customerPoints = $customerPoints - $priz->price;

            if ($customerPoints < 0) {
               return;
            }

            $typeTransaction = DB::table('type_transactions')->where('name', 'Débito')->first();

            $deal = Deal::create([
                'idCustomer' => $customer->id,
                'cnpj' => Auth::user()->cnpj,
                'idTypeTransactions' => $typeTransaction->id,
                'idPrize' => $request['idPrize'],
                'updated_at' => $request->input('updated_at'),
                'created_at' => $request->input('created_at'),
            ]);
            
            DB::table('customers')
                ->where('id', $customer->id)
                ->update(['points' => $customerPoints]);

           $customers = DB::table('customers')->where(['cnpj' => Auth::user()->cnpj, 'cpf' => $customer->cpf])->get();

            return $customers;      
        }

        return $customers = [
            "nome" => "",
            "cpf" => "",
            "cnpj" => "",
            "pontos" => ""
        ];

        
    }

    protected function storeDebit(Request $request){
        $this->makeDebit($request);

        return redirect()->route('customers.index');
    }

    protected function add()
    {
        return view('deals.transacao_def_goals');
    }

    //show
    protected function show($id)
    {
        $members = Deal::find($id);
        return view('deals.show',compact('members'));
    }
    //edit
    public function edit($id)
    {
        $members = Deal::find($id);
        return view('deals.edit',compact('members'));
    }
    //update
    public function update(Request $request, $id)
    {
        Deal::find($id)->update($request->all());
        return redirect()->route('deals.index')
                        ->with('success','deals updated successfully');
    }
    //destroy
    protected function destroy($id)
    {
        return Deal::destroy([
            Deal::find($id)->delete()]);
            return redirect()->route('deals.index')
                            ->with('success','deals deleted successfully');
    }
}
     ?>