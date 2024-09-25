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
        $projects = Project::active()->available()->beforeEndDate()->latest()->paginate(getPaginate(18));

        return view('Template::projects.index', compact('pageTitle', 'projects', 'categories'));
    }

    public function projectDetails($slug)
    {
        $pageTitle = 'Project Details';
        $project = Project::where('slug', $slug)->firstOrFail();

        $seoContents = $project->seo_content;
        $path = 'assets/images/frontend/project/seo';
        $seoImage = @$seoContents->image ? getImage($path . '/' . @$seoContents->image, getFileSize('seo')) : null;

        return view('Template::projects.project_details', compact('pageTitle', 'project', 'seoContents', 'seoImage'));
    }

    public function checkQuantity(Request $request)
    {
        $validatedData = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'quantity' => 'required|integer|min:1',
        ]);
        $projectId = $validatedData['project_id'];
        $requestedQuantity = (int)$validatedData['quantity'];

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
        $projects = Project::active()->searchable(['title'])->beforeEndDate()->available();

        if ($request->has('category') && !empty($request->category)) {
            $projects = $this->filterItem($request, $projects, 'category');
        }

        if ($request->has('return_type') && !empty($request->return_type)) {
            $projects = $this->filterItem($request, $projects, 'return_type');
        }

        $projects = $projects->latest()->paginate(getPaginate());

        $viewType = $request->input('viewType', 'grid');

        // Return the appropriate view based on viewType
        if ($viewType === 'list') {
            $view = view('Template::projects.list-project', compact('projects', 'categories', 'pageTitle'))->render();
        } else {
            $view = view('Template::projects.project', compact('projects', 'categories', 'pageTitle'))->render();
        }

        return response()->json([
            'view' => $view,
            'totalProjects' => $projects->total(),
        ]);
    }

    protected function filterItem($request, $projects, $type)
    {
        $col = $type == 'category' ? ($type . '_id') : $type;

        if (is_array($request->$type)) {
            $projects->whereIn($col, $request->$type);
        } else {
            $projects->where($col, $request->$type);
        }

        return $projects;
    }
}
