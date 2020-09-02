<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests;
use App\Http\Requests\ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Mail;
use App\Mail\ClientMail;
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
        $skill = Skill::select('name','id')->get();
        $skill = $skill->pluck('name','id');//select('id','name')->get();
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
        $client = new Client();
        
        if($request->hasFile('avatar')){
            //'/storage/' . $filePath;
            //dd($request->file('avatar')->getClientOriginalName());
            $fileName = $this->UploadFile($request);
            $client->avatar =  $fileName;
            $client->nombre = $request->name;
            $client->email = $request->email;
            $client->phone = $request->phone;
            $client->id_skill = $request->id_skill;
            if($client->save()){
                Mail::to($client->email)->send(new ClientMail($client));
                return redirect()->route('clients.create')->with('success', 'Create Succesfully');
            }else{
                return redirect()->route('clients.create')->with('warning', 'Error Save Data');
            }
            
            //return ($fileName);
        }else{
            return redirect()->route('clients.create')->with('warning', 'Error Image Fail');
        }
        //$request->avatar->store('images');
    }
    
    public function edit($id)
    {   
        $skill = Skill::pluck('name','id');
        $data = Client::find($id);
        return view('edit', compact(['data', 'skill']));
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
        if($request->hasFile('avatar')){
            Storage::disk('public')->delete('images/'.$cliente->avatar);
            $fileName = $this->UploadFile($request);
            $cliente->avatar =  $fileName;
        }
        $cliente->nombre = e($request->input('name'));
        $cliente->email = e($request->input('email'));
        $cliente->phone = e($request->input('phone'));
        $cliente->id_skill = e($request->input('id_skill'));
        
        $cliente->update();
        
        //Client::where('id', $id)->update($request->all());

        return redirect('/clients')->with('success', 'Update Succesfully');
    }

    public function destroy($id)
    {
        $this->DeleteImage($id);
        Client::where('id',$id)->delete();
        return redirect('/clients')->with('success','Delete Successfully');
    }

    public function UploadFile($request)
    {
        $id = substr(md5(time()), 0, 16);
        $img = $request->file('avatar');
        $fileName = 'profile_'.$id.'_'.$img->getClientOriginalName();
        $filePath = $img->storeAs('images', $fileName, 'public');
        return ($fileName);
    }

    public function DeleteImage($id)
    {
        $cliente = Client::find($id);
        Storage::disk('public')->delete('images/'.$cliente->avatar);
    }
}
