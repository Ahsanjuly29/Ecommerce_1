<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\CapacityTypeRequest;
use App\Models\backend\CapacityType;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;

class CapacityTypeController extends Controller
{

    public function index(Request $request)
    {
        $data = [
            'title' => 'Capacity Type',
            'capacityTypes' => CapacityType::get()
        ];

        if ($request->id) {
            $data['editCapacity'] = CapacityType::find($request->id);
        }

        return view('backend.capacityType', $data);
    }

    public function store(CapacityTypeRequest $request)
    {
        try {
            CapacityType::create($request->validated());
            return back()->withSuccess('Added Succesfully');
        } catch (\Exception $ex) {
            return back()->withError($ex->getMessage());
        }
    }

    public function update(CapacityTypeRequest $request, CapacityType $capacityType)
    {
        try {
            $capacityType->update([
                'slug' => $request->slug
            ]);
            return redirect()->route('capacity-type-index')->withSuccess("New value '{$request->slug}' Updated Succesfully");
        } catch (\Exception $ex) {
            return back()->withError($ex->getMessage());
        }
    }

    public function delete(Request $request)
    {
        CapacityType::destroy(explode(',', $request->ids));
        return redirect()->route('capacity-type-index')->withSuccess('Deleted Succesfully');
    }
}
