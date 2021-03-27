<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class AjaxController extends Controller
{
    public function teamUser(Request $request)
	{
        $users = User::where('is_active', true)
                        ->where('team_id', $request->query('team_id'))
                        ->get();
		return response()->json($users);
    }
}
