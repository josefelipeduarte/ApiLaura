<?php

namespace App\Http\Controllers;

use App\Enum\StateEnum;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'state' => [new Enum(StateEnum::class)],
        ]);

        $query = School::query();
        $state = $request->state;
        $schools = $query->when($request->state, function ($query) use ($state) {
            $query->where('state', $state);
        })->get();

        return response()->json(['data' => $schools], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'number' => 'required|string|max:10',
            'neighborhood' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'complement' => 'nullable|string',
            'state' => ['required', new Enum(StateEnum::class)],
        ]);

        School::create($request->all());

        return response()->noContent(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\School $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        return $school;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\School $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School $school)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:255',
            'number' => 'nullable|string|max:10',
            'neighborhood' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'complement' => 'nullable|string',
            'state' => ['nullable', Rule::enum(StateEnum::class)],
        ]);

        $school->update($request->all());

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\School $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        $school->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
