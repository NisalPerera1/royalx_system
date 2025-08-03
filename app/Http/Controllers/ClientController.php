<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Client::latest()->get();

            return DataTables::of($data)
                ->setRowId(fn($client) => $client->id)
                ->addColumn('action', fn($client) => view('client.includes.actions', ['model' => $client]))
                ->addIndexColumn()
                ->make(true);
        }

        return view('client.index');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string',
        'contact' => 'required|string',
        'address' => 'nullable|string',
        'id_proof' => 'nullable|string',
        'id_proof_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'guarantor' => 'nullable|string',
    ]);

    // Handle file upload if exists
    if ($request->hasFile('id_proof_file')) {
        $validated['id_proof_file'] = $request->file('id_proof_file')->store('id_proofs', 'public');
    }

    // Now create the client with all validated + uploaded data
    $client = Client::create($validated);

    return response()->json([
        'message' => 'Client added successfully!',
        'client' => $client
    ]);
}


   public function update(Request $request, $id)
{
    // Validate the incoming request data, including an optional file upload.
    $validated = $request->validate([
        'edit_name'           => 'required|string',
        'edit_contact'        => 'required|string',
        'edit_address'        => 'nullable|string',
        'edit_id_proof'       => 'nullable|string',
        'edit_guarantor'      => 'nullable|string',
        'edit_id_proof_file'  => 'nullable|image|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    // Find the client by ID.
    $client = Client::findOrFail($id);

    // Prepare the update data array.
    $data = [
        'name'      => $validated['edit_name'],
        'contact'   => $validated['edit_contact'],
        'address'   => $validated['edit_address'] ?? null,
        'id_proof'  => $validated['edit_id_proof'] ?? null,
        'guarantor' => $validated['edit_guarantor'] ?? null,
    ];

    // Check if a new image file is uploaded.
    if ($request->hasFile('edit_id_proof_file')) {
        // Optionally, you could delete the old file here if needed.
        $data['id_proof_file'] = $request->file('edit_id_proof_file')->store('id_proofs', 'public');
    }

    // Update the client record.
    $client->update($data);

    return response()->json([
        'message' => 'Client updated successfully!',
        'client'  => $client
    ]);
}


    public function delete(Request $request)
    {
        $client = Client::findOrFail($request->delete_id);
        $client->delete();

        return response()->json(['message' => 'Client deleted successfully!']);
    }
}


