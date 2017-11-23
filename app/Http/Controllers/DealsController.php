<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Deal;
use App\Http\Controllers\CustomerController;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\Auth;

//Transações

class DealsController extends Controller
{

    public function index()
    {
        $members = Deal::latest()->paginate(10);
        return view('deals.transacao_def',compact('members'));
    }

    protected function store(Request $data)
    {

        $customer = $this->storeCustomer($data);

        $cpf = $customer->cpf;

        $cnpj = Auth::user()->cnpj;

        $customerPoints = $customer->points;        

        $deal = Deal::create([
            'idCustomer' => $customer->id,
            'cnpj' => Auth::user()->cnpj,
            'idTypeTransactions' => 1,
            'amount' => $data->input('amount'),
            'updated_at' => $data->input('updated_at'),
            'created_at' => $data->input('created_at'),
        ]);


        $customerGoals = DB::table('customer_goals')->where('idCustomers', $customer->id)->get();

        foreach ($customerGoals as $customerGoal) {
            $customerGoalsAmountRestrict = $customerGoal->amountRestrict;
            $customerGoalsAmountStored = 0;
            $goal = DB::table('goals')->where('id', $customerGoal->idGoals)->first();
         //   foreach ($goals as $goal) {
                $idRuleToRestrict = $goal->idRuleToRestrict;
                $ruleToRestrict = DB::table('rules_to_restricts')->where('id', $idRuleToRestrict)->first();

                $lastDate = new DateTime(@"$customerGoal->updated_at");

                $todays = new DateTime(@"$_SERVER->REQUEST_TIME");
                
                $restriction = $lastDate->diff($todays);
                $days = $restriction->format('%I');

                if ($days >= $ruleToRestrict->amount) {
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
        $customers = DB::table('customers')->where('cnpj',Auth::user()->cnpj)->get();
        return redirect()->route('customers.index');
    }

    protected function verifyDate(){

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

    protected function storeByGoal(Request $request){
        $customer = $this->storeCustomer($request);
        $customerPoints = $customer->points;

        $deal = Deal::create([
            'idCustomer' => $customer->id,
            'cnpj' => Auth::user()->cnpj,
            'idTypeTransactions' => 1,
            'idGoals' => $data['idGoals'],
            'updated_at' => $data->input('updated_at'),
            'created_at' => $data->input('created_at'),
        ]);

        $goal = DB::table('goals')->where('id', $data['idGoals'])->first();
        $award = DB::table('rules_to_awards')->where('id', $goal->idRuleToAward)->first();

        $customerPoints += $award->amount;

        DB::table('customers')
            ->where('id', $customer->id)
            ->update(['points' => $customerPoints]);

        return redirect()->route('customers.index');
    }

    protected function debit(){
        return view('deals.debit');
    }

    protected function storeDebit(Request $request){
        $customer = $this->storeCustomer($request);
        $customerPoints = $customer->points;
        $deal = Deal::create([
            'idCustomer' => $customer->id,
            'cnpj' => Auth::user()->cnpj,
            'idTypeTransactions' => 2,
            'idPrize' => $data['idPrize'],
            'updated_at' => $data->input('updated_at'),
            'created_at' => $data->input('created_at'),
        ]);

        $prize = DB::table('prizes')->where('id', $data['idPrize'])->first();
        $customerPoints -= $prize->price;

        if ($customerPoints < 0) {
           return redirect()->route('customers.index');
        }

        DB::table('customers')
            ->where('id', $customer->id)
            ->update(['points' => $customerPoints]);

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