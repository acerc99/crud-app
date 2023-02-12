<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;

class SkillController extends Controller
{
    public function getSkills(Request $request)
    {
        // dd(1);
        $skills = Skill::all();
        return response()->json($skills);
    }
}
