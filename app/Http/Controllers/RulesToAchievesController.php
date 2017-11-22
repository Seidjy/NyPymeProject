<?php

namespace App\Http\Controllers;

use App\RulesToAchieve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RulesToAchievesController extends Controller
{
	//index
	protected function index()
    {
	        $achieve = RulesToAchieve::latest()->paginate(5);
	        return view('achieve.index',compact('achieve'));
	}
	//create
    protected function create()
    {
        $achieves = DB::table('type_achieves')->get();
        return view('achieve.evento_requisito', ['achieves' => $achieves]);
    }
    //store
    protected function store(Request $request)
    {
        $cnpj = Auth::user()->cnpj;
        $name = $request["name"];

        $id = md5("$name$cnpj");
        RulesToAchieve::create([
            'id' => $id,
            'cnpj' => $cnpj,
            'name' => $name,
            'idTypeAchieve' => $request['idTypeAchieve'],
            'amount' => $request['amount'],
            'gather' => $request['gather'],
        ]);
        return view('home');
	}
    //show
    protected function show($id)
    {
        $article = RulesToAchieve::find($id);
        return view('achieve.show',compact('article'));
    }
    //edit
    public function edit($id)
    {
        $article = RulesToAchieve::find($id);
        return view('achieve.edit',compact('article'));
    }
    //update
    public function update(Request $request, $id)
    {
        RulesToAchieve::find($id)->update($request->all());
        return redirect()->route('achieve.index')
                        ->with('success','rulesToAchieves updated successfully');
    }
    //destroy
    protected function destroy($id)
    {
        RulesToAchieve::find($id)->delete();
	        return redirect()->route('achieve.index')
	        ->with('success','rulesToAchieves deleted successfully');

    }
}