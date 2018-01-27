<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RulesToRestrict;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RulesToRestrictsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //index
	protected function index()
    {
        $data = RulesToRestrict::latest()->paginate(5);
        return view('restricts.index',compact('data'));
	}
	//create
    protected function create()
    {
        $typeRestrict = DB::table('type_restricts')->get();
        return view('restricts.limitacao_def', ['restricts' => $typeRestrict]);
    }

    //store
    protected function store(Request $request)
    {
            $cnpj = Auth::user()->cnpj;
            $name = $request["name"];
            $id = md5("$name$cnpj");  
	        RulesToRestrict::create([
                'id' => $id,
                'cnpj' => $cnpj,
                'name' => $name,
                'idTypeRestrict' => $request['idTypeRestrict'],
                'amount' => $request['amount'],
            ]);
	        return view('home');
	}

    //show
    protected function show($id)
    {
        $article = RulesToRestrict::find($id);
        return view('restricts.show',compact('article'));
    }
    //edit
    public function edit($id)
    {
        $article = RulesToRestrict::find($id);
        return view('restricts.edit',compact('article'));
    }
    //update
    public function update(Request $request, $id)
    {
        RulesToRestrict::find($id)->update($request->all());
        return redirect()->route('restricts.index')
                        ->with('success','rulesToRestricts updated successfully');
    }
    //destroy
    protected function destroy($id)
    {
        RulesToRestrict::find($id)->delete();
        return redirect()->route('restricts.index')
	                        ->with('success','rulesToRestricts deleted successfully');

    }
}
