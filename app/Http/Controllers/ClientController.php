<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests;
use App\Http\Requests\ClientRequest;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $data= Client::orderBy('id', 'desc')->paginate(10)->setPath('clients');
        return view('index', compact(['data']));
    }

    public function create()
    {
        return view('create');
    }

    public function store(ClientRequest $request)
    {
        /*
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required'
        ]); */
        Client::create($request->all());
        return redirect()->route('clients.create')->with('success', 'Create Succesfully');
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
