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


    public function checkQuantity(Request $request)
    {
        $projectId = $request->input('project_id');
        $requestedQuantity = (int) $request->input('quantity');

        $project = Project::findOrFail($projectId);

        if ($requestedQuantity > $project->available_share) {
            return response()->json([
                'status' => 'error',
                'message' => 'Requested quantity exceeds available shares.',
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Requested quantity is available.',
        ]);
    }
}
