<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests;
use App\Http\Requests\ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\SkillController;
use App\Skill;

class ClientController extends Controller
{
    public function index()
    {
        $data= Client::select('clients.id','clients.name', 'clients.email', 'clients.phone', 'skills.name as skill', 'skills.tecno');
        $data = $data->join('skills', 'skills.id', '=', 'clients.id_skill')
                    ->get();
                        
        //orderBy('id', 'desc')->paginate(10)->setPath('clients'); 
        /*$clients=DB::table('clients')->get();
        foreach ($clients as $client)
        {
           $data[]=[
            'id'=>$client->id,
            'name'=>Crypt::decrypt($client->name),
            'email'=>Crypt::decrypt($client->email),
            'phone'=>($client->phone)
           ];
        }*/
        return view('index', compact(['data']));//($data);//
    }

    public function create()
    {
        $skill = Skill::pluck('name','id');//select('id','name')->get();
        return view('create', compact(['skill']));
    }

    public function store(ClientRequest $request)
    {
        /*
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required'
        ]); */
        $client = Client::create($request->all());
        return ($client);//redirect()->route('clients.create')->with('success', 'Create Succesfully');
    }
    
    public function edit($id)
    {
        $data = Client::find($id);
        return view('edit', compact(['data']));
    }

    public function show($id)
    {
        $data = Client::find($id);
        return view('edit', compact(['data']));
    }

    public function update(ClientRequest $request, $id)
    {
        /*
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required'
        ]); */
        
        $cliente = Client::find($id);
        $cliente->name = $request->get('name');
        $cliente->email = $request->get('email');
        $cliente->phone = $request->get('phone');
        $cliente->update();
        
        //Client::where('id', $id)->update($request->all());

        return redirect('/clients')->with('success', 'Update Succesfully');
    }

    public function destroy($id)
    {
        Client::where('id',$id)->delete();
        return redirect('/clients')->with('success','Delete Successfully');
    }
}
