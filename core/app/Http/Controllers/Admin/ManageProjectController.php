<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;

class ManageProjectController extends Controller
{

    public function index()
    {
        $pageTitle = 'All Projects';
        $projects = Project::orderByDesc('id')->searchable('title')->paginate(getPaginate());


        return view('admin.project.index', compact('pageTitle', 'projects'));
    }

    public function create()
    {
        $pageTitle = 'New Project';

        return view('admin.project.create', compact('pageTitle'));
    }

    public function store(Request $request, $id = 0)
    {
        $request->validate([
            'title' => 'required|string|max:191',
            'goal' => 'required|numeric|min:1',
//            'image' => 'required|image',new FileTypeValidate(['jpg','jpeg','png']),
            'description' => 'required|string',
            'share_amount' => 'required|numeric|min:1',
            'share_count' => 'required|numeric|min:1',
            'roi_amount' => 'required|numeric|min:1',
            'roi_percentage' => 'required|numeric|min:1',
            'map_url' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
//            'capital_back' => 'required|numeric|in:0,1',
            'maturity_time' => 'required|numeric|min:1',
        ]);

        if ($id) {
            $project = Project::findOrFail($id);
            $notify[] = ['success', 'Project updated successfully'];
        } else {
            $project = new Project();
            $notify[] = ['success', 'Project created successfully'];
        }

        if ($request->hasFile('image')) {
            try {
                $old = $project->image ?? null;
                $project->image = fileUploader($request->image, getFilePath('project'), getFileSize('project'), $old);
            } catch (\Exception $e) {
                $notify[] = ['error', 'Could not upload your image'];
                return back()->withNotify($notify);
            }
        }

        $project = new Project();
        $project->title = $request->title;
        $project->slug = $request->slug;
        $project->goal = $request->goal;
        $project->share_amount = $request->share_amount;
        $project->share_count = $request->share_count;
        $project->roi_amount = $request->roi_amount;
        $project->roi_percentage = $request->roi_percentage;
        $project->description = $request->description;
        $project->map_url = $request->map_url;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
//        $project->capital_back = $request->capital_back;
        $project->maturity_time = $request->maturity_time;



        $project->save();
        return redirect()->route('admin.project.index')->withNotify($notify);
    }


    public function checkSlug($id = null){
        $page = Project::where('slug',request()->slug);
        if ($id) {
            $page = $page->where('id','!=',$id);
        }
        $exist = $page->exists();
        return response()->json([
            'exists'=>$exist
        ]);
    }
}
