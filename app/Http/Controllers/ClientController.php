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
        $data= Client::select('clients.id','clients.avatar','clients.nombre', 'clients.email', 'clients.phone', 'skills.name')
                        ->join('skills', 'skills.id', '=', 'clients.id_skill')
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
        //$client = Client::create($request->all());
        $client = new Client;
        $id = substr(md5(time()), 0, 16);
        if($request->file()){
            $fileName = 'profile_'.$id.'_'.$request->file('avatar')->getClientOriginalName();
            $filePath = $request->file('avatar')->storeAs('images', $fileName, 'public');
            
            $client->avatar =  $fileName;//'/storage/' . $filePath;
            $client->nombre = $request->name;
            $client->email = $request->email;
            $client->phone = $request->phone;
            $client->id_skill = $request->id_skill;
            $client->save();
            return redirect()->route('clients.create')->with('success', 'Create Succesfully');
            //dd($request->file('avatar')->getClientOriginalName());
        }else{
            return redirect()->route('clients.create')->with('warning', 'error file Succesfully');
        }
        //$request->avatar->store('images');
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
