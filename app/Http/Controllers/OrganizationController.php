<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;
use App\Models\Organization;
use Illuminate\Http\Response;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Organization::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrganizationRequest $request)
    {
        $organization = new Organization();
        $organization->name = $request->validated('name');
        $organization->save();

        return response(status: Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Organization $organization)
    {
        return $organization;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrganizationRequest $request, Organization $organization)
    {
        $organization->name = $request->validated('name');
        $organization->save();
        return response(status: Response::HTTP_NO_CONTENT);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organization $organization)
    {
        $organization->delete();
        return response(status: Response::HTTP_NO_CONTENT);
    }
}
