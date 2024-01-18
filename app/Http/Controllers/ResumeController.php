<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use App\Models\Education;
use App\Models\CV;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class ResumeController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function index()
    {
        if (CV::all()->count() < 1) {
            return view('cv.blank');
        }
        $cv =  CV::all()->first();
        return $this->show($cv->id);
    }

    public function show(int $id)
    {

        $cv = CV::findOrFail($id);

        $id = 1;

        if (Contacts::where('id', $id)->count() > 0) {
            $contacts = Contacts::find($id);
        } else {
            $contacts = NULL;
        }

        return view('cv.show')->with('cv', $cv)->with('contacts', $contacts);
    }

    public function edit(int $id)
    {
        $cv = CV::findOrFail($id);

        return view('cv.edit')->with('cv', $cv);
    }

    public function submit(Request $q, int $id)
    {
        $cv = CV::findOrFail($id);

        $cv->name = $q->input("cv.name");

        $cv->info = $q->input("cv.info");

        $cv->save();

        return response(200);
    }

    public function new()
    {
        return view('cv.create');
    }

    public function create(Request $q)
    {
        $name = $q->input("cv.name");
        $info = $q->input("cv.info");
        $cv = new CV(['name' => $name, 'info' => $info]);
        $cv->save();

        if ($cv->save()) {
            $id = $cv->id;
        } else $id = -1;

        return response($id);
    }

    public function delete(int $id)
    {
        $cv = CV::findOrFail($id);

        $cv->delete();

        return redirect('/home');
    }













    private function formCV($id): array
    {
        $cv = [];

        $cv['id'] = $id;

        $cv['name'] = CV::where('id', $id)->first()->name;

        $skills = DB::table('cv')
            ->join('cv_skill', 'cv.id', '=', 'cv_skill.cv_id')
            ->join('skill', 'cv_skill.skill_id', '=', 'skill.id')
            ->where('cv.id', $id)->select('skill.name')->get();

        $cv['skills'] = $skills;

        $education = DB::table('cv')
            ->join('cv_edu', 'cv.id', '=', 'cv_edu.cv_id')
            ->join('education', 'cv_edu.edu_id', '=', 'education.id')
            ->where('cv.id', $id)
            ->select(
                'education.start_date as start',
                'education.end_date as end',
                'education.institution as institution',
                'education.description as description'
            )->get();

        $cv['education'] = $education;

        $experience = DB::table('cv')
            ->join('cv_exp', 'cv.id', '=', 'cv_exp.cv_id')
            ->join('experience', 'cv_exp.exp_id', '=', 'experience.id')
            ->where('cv.id', $id)
            ->select(
                'experience.start_date as start',
                'experience.id as id',
                'experience.end_date as end',
                'experience.workplace as workplace'
            )->get();

        foreach ($experience as $item) {
            $item->achievements = DB::table('achievement')->where('workplace_id', $item->id)->select('description')->get();
        }

        $cv['experience'] = $experience;

        return $cv;
    }
}
