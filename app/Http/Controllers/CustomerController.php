<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth', ['except' => 'getCustomerAPI']);
    }

    protected function index()
    {
        $customers = DB::table('customers')->where('cnpj', Auth::user()->cnpj)->get();
        return view('customers.index',['clientes' => $customers]);
    }

    public function getCustomerFromStore(Request $request){
        $customers = DB::table('customers')->where(['cnpj' => Auth::user()->cnpj, 'cpf' => $request->input('cpf')])->get();

         $counter = 0;
        foreach ($customers as $client ) {
            $response[$counter] =  [
                "nome" => $client->name,
                "cpf" => $client->cpf,
                "cnpj" => $client->cnpj,
                "pontos" => $client->points
            ];
        }

        return response()->json($response);
    }


    public function getCustomer(Request $request){
        $customer = DB::table('customers')->where('cpf', $request->input('cpf'))->get();
        return $customer;
    }

    public function getCustomerAPI(Request $request){
        $customer = $this->getCustomer($request);

        $counter = 0;
        foreach ($customer as $client ) {
            $response[$counter] =  [
                "nome" => $client->name,
                "cpf" => $client->cpf,
                "cnpj" => $client->cnpj,
                "pontos" => $client->points
            ];
        }
        
        return response()->json(["participante" => $response]);
    }

    //create
    protected function create()
    {
        return view('customers.create');
    }
     //store
    protected function store(Request $request)
    {
        
    }

    public static function addCustomer($cpf, $name){
        $cnpj = Auth::user()->cnpj;
        $id = md5("$cpf$cnpj");
        $customer = Customer::create([
            'id' => $id,
            'cpf' => $cpf,
            'name' => "",
            'cnpj' => $cnpj,
            'points' => 0,
        ]);

        $customer = DB::table('customers')->where([
            ['cpf', $cpf],
            ['cnpj', Auth::user()->cnpj],
        ])->first();

        $goals = DB::table('goals')->where('cnpj',Auth::user()->cnpj)->get();
        
        foreach ($goals as $goal) {
            $idCustomerGoal = md5("$cnpj$goal->id$customer->id");
            DB::table('customer_goals')->insert([
                'id' => $idCustomerGoal,
                'idGoals' => $goal->id,
                'idCustomers' => $customer->id,
                'cnpj' => $cnpj,
                'amountRestrict' => 0,
                'amountStored' => 0,
                'created_at' => '2015-01-01',
                'updated_at' => '2015-01-01',
            ]
            );
        }
        return $customer;
    }

    //show
    protected function show($id)
    {
        $members = Customer::find($id);
        return view('customers.show',compact('members'));
    }
    //edit
    public function edit($id)
    {
        $members = Customer::find($id);
        return view('customers.edit',compact('members'));
    }

    //update
    public function update(Request $request, $id)
    {
        Customer::find($id)->update($request->all());
        return redirect()->route('customers.index')
                        ->with('success','goals updated successfully');
    }

    //destroy
    protected function destroy($id)
    {
        Customer::find($id)->delete();
        return redirect()->
        route('customers.index')->
        with('success','goals deleted successfully');
    }
}