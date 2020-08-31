<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SkillRequest;
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

    public function store(SkillRequest $request)
    {
        
        $skill = new Skill;
        $skill->name = ($request->name . " - " . $request->tecno);
        $skill->save();
        //Skill::create($request->all());
        return redirect()->route('skills.create')->with('success', 'Create Succesfully');//($skill);
    }
}