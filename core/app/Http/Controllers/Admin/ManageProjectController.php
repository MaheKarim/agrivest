<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Project;
use App\Models\Time;
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
        $times = Time::active()->get();
        $categories = Category::active()->get();

        return view('admin.project.create', compact('pageTitle', 'times', 'categories'));
    }

    public function edit($id)
    {
        $pageTitle = 'Edit Project';
        $project = Project::findOrFail($id);
        $times = Time::active()->get();
        $categories = Category::active()->get();

        $galleries  = [];

        foreach ($project->gallery ?? [] as $key => $gallery) {
            $img['id']   = $gallery;
            $img['src']  = getImage(getFilePath('projectGallery') . '/' . $gallery);
            $galleries[] = $img;
        }

        return view('admin.project.create', compact('pageTitle', 'project', 'times', 'galleries', 'categories'));
    }

    public function store(Request $request, $id=0)
    {
        $isRequired = $id ? 'nullable' : 'required';

        $request->validate([
            'title' => 'required|string|max:191',
            'goal' => 'required|numeric|min:1',
            'description' => 'required|string',
            'share_amount' => 'required|numeric|min:1',
            'share_count' => 'required|numeric|min:1',
            'roi_amount' => 'required|numeric|min:1',
            'roi_percentage' => 'required|numeric|min:1',
            'map_url' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'maturity_time' => 'required|numeric|min:1',
            'image'     => [$isRequired, 'image', new FileTypeValidate(['jpeg', 'jpg', 'png'])],
            'gallery'   => "$isRequired|array|min:0|max:5",
            'gallery.*'  => [$isRequired, 'image', new FileTypeValidate(['jpeg', 'jpg', 'png'])],
            'category_id' => "$isRequired|exists:categories,id",
            'time_id' => "$isRequired|exists:times,id",
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

        $gallery = $id ? $project->gallery : [];

        if ($request->hasFile('gallery')) {
            foreach ($request->gallery as $singleImage) {
                try {
                    $gallery[] = fileUploader($singleImage, getFilePath('projectGallery'), getFileSize('projectGallery'));
                } catch (\Exception $exp) {
                    $notify[] = ['error', 'Couldn\'t upload your product gallery image'];
                    return back()->withNotify($notify);
                }
            }
        }

        $project->title = $request->title;
        $project->slug = $request->slug;
        $project->goal = $request->goal;
        $project->share_count = $request->share_count;
        $project->share_amount = $request->share_amount;
        $project->roi_percentage = $request->roi_percentage;
        $project->roi_amount = $request->roi_amount;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->maturity_time = $request->maturity_time;
        $project->time_id = $request->time_id;
        $project->category_id = $request->category_id;
        $project->return_interval = $request->return_interval;
        $project->return_timespan = $request->return_timespan;
        $project->map_url = $request->map_url;
        $project->capital_back = $request->capital_back;
        $project->return_type = $request->return_type;
        $project->description = $request->description;
        $project->gallery        = $gallery;
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

    public function status($id)
    {
        return Project::changeStatus($id);
    }
}
