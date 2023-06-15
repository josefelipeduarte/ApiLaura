<?php

namespace App\Http\Controllers;

use App\Enum\ClassificationEnum;
use App\Enum\ComplaintStatusEnum;
use App\Http\Resources\ComplaintResource;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate(
            [
                'per_page' => 'required|integer',
                'school_id' => ['nullable', 'integer'],
                'organization_id' => ['nullable', 'integer'],
                'description' => 'nullable|string',
                'status' => ['nullable', Rule::enum(ComplaintStatusEnum::class)],
                'classification' => ['nullable', Rule::enum(ClassificationEnum::class)],
            ]
        );

        $query = Complaint::query();

        $query->when(!$request->user()->is_admin, function ($query) use ($request) {
            $query->where('user_id', $request->user()->id);
        });

        $query->when(isset($validated['status']), function ($query) use ($validated) {
            $query->where('status', $validated['status']);
        });

        $query->when(isset($validated['school_id']), function ($query) use ($validated) {
            $query->where('school_id', $validated['school_id']);
        });

        $query->when(isset($validated['organization_id']), function ($query) use ($validated) {
            $query->where('organization_id', $validated['organization_id']);
        });

        $query->when(isset($validated['description']), function ($query) use ($validated) {
            $query->where('description', 'like', '%' . $validated['description'] . '%');
        });

        $query->when(isset($validated['classification']), function ($query) use ($validated) {
            $query->where('classification', $validated['classification']);
        });

        $query->orderByDesc('created_at');

        $complaints = $query->paginate($validated['per_page']);

        return ComplaintResource::collection($complaints);
    }

    public function store(Request $request)
    {
        $request->validate([
            'school_id' => ['required', 'integer'],
            'organization_id' => ['required', 'integer'],
            'is_anonymous' => 'required|bool',
            'description' => 'required|string',
            'classification' => ['nullable', Rule::enum(ClassificationEnum::class)],
        ]);

        $requestData = $request->all();
        $requestData['user_id'] = $request->boolean('is_anonymous') ? null : $request->user()->id;
        unset($requestData['is_anonymous']);

        $complaint = Complaint::create($requestData);

        return response()->json($complaint, Response::HTTP_CREATED);
    }

    public function show(Complaint $complaint)
    {
        return ComplaintResource::make($complaint);
    }

    public function update(Request $request, Complaint $complaint)
    {
        $data = $request->validate([
            'organization_id' => ['required', 'integer'],
            'status' => ['nullable', Rule::enum(ComplaintStatusEnum::class)],
            'classification' => ['nullable', Rule::enum(ClassificationEnum::class)],
        ]);

        $complaint->update($data);

        return response()->noContent();
    }

    public function destroy(Complaint $complaint)
    {
        $complaint->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
