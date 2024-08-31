<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function projects()
    {
        $pageTitle = 'Projects';
        $categories = Category::active()->get();
        $projects = Project::active()->latest()->paginate(getPaginate());

        return view('Template::projects.all_projects', compact('pageTitle', 'projects','categories'));
    }


    public function projectDetails($slug)
    {
        $pageTitle = 'Project Details';
        $project = Project::where('slug', $slug)->firstOrFail();

        return view('Template::projects.project_details', compact('pageTitle', 'project'));

    }
}
