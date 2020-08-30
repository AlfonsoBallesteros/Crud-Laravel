<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Skill;

class SkillController extends Controller
{
    public function index()
    {
        $skill = Skill::all();
        return view($skill);
    }
    
    public function create()
    {
        return view('createskill');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'tecno'=>'required',
        ]);
        Skill::create($request->all());
        return redirect()->route('skills.create')->with('success', 'Create Succesfully');
    }
}
