<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Frontend\Collection\StoreCollectionRequest;
use App\Http\Requests\Frontend\Collection\UpdateCollectionRequest;

class CollectionController extends Controller
{
    public function store(StoreCollectionRequest $request)
    {
        $collection = auth()->user()->collections()->create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $collection->courses()->toggle($request->course_id);

        return response()->json([
            'success' => true,
            'collection' => [
                'id' => $collection->id,
                'name' => $collection->name,
                'description' => $collection->description,
                'course_count' => $collection->courses()->count(),
            ],
            'collections' => view('frontend.user-courses.includes.collections', ['collections' => auth()->user()->collections()->with('courses')->get()])->render(),
        ], 201);
    }

    public function update(UpdateCollectionRequest $request, Collection $collection)
    {
        $collection->update($request->validated());

        return response()->json([
            'success' => true,
            'collections' => view('frontend.user-courses.includes.collections', ['collections' => auth()->user()->collections()->with('courses')->get()])->render(),
        ], 200);
    }

    public function destroy($id)
    {
        $collection = Collection::findOrFail($id);
        $collection->delete();

        return response()->json([
            'collections' => view('frontend.user-courses.includes.collections', [
                'collections' => Auth::user()->collections()->with('courses')->get()
            ])->render()
        ]);
    }
}
