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
        $projects = Project::active()->latest()->paginate(getPaginate(3));

        return view('Template::projects.all_projects', compact('pageTitle', 'projects', 'categories'));
    }

    public function projectDetails($slug)
    {
        $pageTitle = 'Project Details';
        $project = Project::where('slug', $slug)->firstOrFail();

        session()->put('project', [
            'id' => $project->id,
        ]);

        return view('Template::projects.project_details', compact('pageTitle', 'project'));
    }

    public function checkQuantity(Request $request)
    {
        $projectId = $request->input('project_id');
        $requestedQuantity = (int)$request->input('quantity');

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

    public function filter(Request $request)
    {
        $pageTitle = 'Projects';
        $categories = Category::active()->get();
        $projects = Project::active();

        $search = $request->has('search') ? $request->search : '';
        if (!empty($search)) {
            $projects->where('title', 'like', '%' . $search . '%');
        }

        // Category filter
        if ($request->has('category') && !empty($request->category)) {
            if (is_array($request->category)) {
                $projects->whereIn('category_id', $request->category);
            } else {
                $projects->where('category_id', $request->category);
            }
        }


        $projects = $projects->latest()->paginate(getPaginate());

        return response()->json([
            'view' => view('Template::projects.project', compact('projects', 'categories', 'pageTitle'))->render(),
            'totalProjects' => $projects->total(),
        ]);

    }
}
