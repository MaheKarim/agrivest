<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Time;
use Illuminate\Http\Request;

class ManageTimeController extends Controller
{
    public function index()
    {
        $pageTitle = 'Manage Time';
        $times = Time::searchable(['name', 'hours'])->latest()->paginate(getPaginate());
        return view('admin.time.index', compact('pageTitle', 'times'));
    }

    public function store(Request $request, $id = 0)
    {
        $time = $id ? Time::findOrFail($id) : new Time();

        $request->validate([
            'name' => 'required|string|max:255|unique:times,name,' . $time->id,
            'hours' => 'required|numeric',
        ]);

        if ($id) {
            $notify[] = ['success', 'Time updated successfully'];
        } else {
            $notify[] = ['success', 'Time added successfully'];
        }

        $time->name = $request->name;
        $time->hours = $request->hours;
        $time->save();

        return redirect()->route('admin.time.index')->withNotify($notify);
    }


    public function status($id)
    {
        return Time::changeStatus($id);
    }
}
