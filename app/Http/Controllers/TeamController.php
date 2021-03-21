<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Models\Team;

class TeamController extends Controller
{
    public function index(){
        if (Gate::denies('access', 'team-list')) {
            return redirect()->route('home');
        }
        $data = [];
        $data['teams'] = Team::paginate();
        return view('teams.list',$data);
    }

    public function create() {
        if (Gate::denies('access', 'team-new')) {
            return redirect()->route('home');
        }
        return view('teams.new');
    }

    public function store(Request $request){ // aynı grup ismini kaydettirme
        $team = new Team();
        $team->name = $request->input('name');
        $team->save();

        return redirect()->route('teams.index')->with('message','işleminiz başarılı bir şekilde yapılmıştır.');
    }

    public function edit(Team $team) {
        if (Gate::denies('access', 'team-edit')) {
            return redirect()->route('home');
        }
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
