<?php

namespace App\Http\Controllers;

use App\Models\ProfessionalDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfessionalDocumentController extends Controller
{
    public function status(Request $request)
    {
        $user = $request->user();
        if (! $user) {
            return response()->json(['data' => null]);
        }

        $record = ProfessionalDocument::query()
            ->where('user_id', $user->id)
            ->latest()
            ->first();

        if (! $record) {
            return response()->json(['data' => null]);
        }

        return response()->json(['data' => $record]);
    }

    public function store(Request $request)
    {
        $user = $request->user();
        if (! $user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Prevent new submission if there's a pending or accepted request
        $exists = ProfessionalDocument::query()
            ->where('user_id', $user->id)
            ->whereIn('status', [ProfessionalDocument::STATUS_PENDING, ProfessionalDocument::STATUS_ACCEPTED])
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Ya cuentas con una solicitud pendiente o aceptada.'], 422);
        }

        $validator = Validator::make($request->all(), [
            'document' => ['required', 'file', 'mimes:pdf,xml', 'max:2048'],
            'specialty' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $path = $request->file('document')->store('professional_documents', 'public');

        $record = ProfessionalDocument::create([
            'user_id' => $user->id,
            'path' => $path,
            'specialty' => (string) $request->input('specialty'),
            'status' => ProfessionalDocument::STATUS_PENDING,
        ]);

        return response()->json(['status' => $record->status, 'data' => $record]);
    }

    public function validateRequest(Request $request, $id)
    {
        // Only admin should call this - route should be protected by middleware
        $validator = Validator::make($request->all(), [
            'status' => ['required', 'in:' . implode(',', [ProfessionalDocument::STATUS_PENDING, ProfessionalDocument::STATUS_ACCEPTED, ProfessionalDocument::STATUS_REJECTED])],
            'reason' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $record = ProfessionalDocument::findOrFail($id);
        $status = $request->input('status');
        $record->status = $status;
        $record->reason = $request->input('reason');
        $record->save();

        $message = $status === ProfessionalDocument::STATUS_ACCEPTED 
            ? 'Usuario validado' 
            : 'Usuario rechazado';

        return redirect()->route('admin.validate-professional-data')->with(
            $status === ProfessionalDocument::STATUS_ACCEPTED ? 'success' : 'error',
            $message
        );
    }

    public function index(Request $request)
    {
        // Admin listing of requests
        $records = ProfessionalDocument::with('user')->orderBy('created_at', 'desc')->get();
        return response()->json(['data' => $records]);
    }

    public function show(Request $request, $id)
    {
        // Admin viewing a specific professional document request
        $record = ProfessionalDocument::with('user')->findOrFail($id);
        return response()->json(['data' => $record]);
    }
}
