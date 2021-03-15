<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

class TeamController extends Controller
{
    public function index(){
        $data = [];
        $data['teams'] = Team::paginate();
        return view('teams.list',$data);
    }

    public function create() {
        return view('teams.new');
    }

    public function store(Request $request){ // aynı grup ismini kaydettirme
        $team = new Team();
        $team->name = $request->input('name');
        $team->save();

        return redirect()->route('teams.index')->with('message','işleminiz başarılı bir şekilde yapılmıştır.');
    }

    public function edit(Team $team) {
        $data = [];
        $data['team'] = $team;
        return view('teams.edit',$data);
    }

    public function update(Request $request, Team $team){
        $team->name = $request->input('name');
        $team->save();

        return redirect()->route('teams.index')->with('message','işleminiz başarılı bir şekilde yapılmıştır.');
    }
}
