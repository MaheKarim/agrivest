<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Project;
use Illuminate\Http\Request;

class ManageFaqController extends Controller
{
    public function addFaq($id)
    {
        $faqs = Faq::where('project_id', $id)->with('project')->paginate(getPaginate());
        $project = Project::findOrFail($id);
        $pageTitle = 'Add Project FAQ for  ' . $project->title;;

        return view('admin.project.faq', compact('pageTitle', 'faqs', 'project'));
    }

    public function storeFaq(Request $request, $id=0)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        if ($id) {
            $faq = Faq::findOrFail($id);
            $notify[] = ['success', 'FAQ updated successfully'];
        } else {
            $faq = new Faq();
            $notify[] = ['success', 'FAQ added successfully'];
        }

        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->project_id = $request->project_id;
        $faq->save();

        return redirect()->route('admin.project.faq.add', ['id' => $faq->project_id])->withNotify($notify);

    }

    public function faqStatus($id)
    {
        return Faq::changeStatus($id);
    }

}
