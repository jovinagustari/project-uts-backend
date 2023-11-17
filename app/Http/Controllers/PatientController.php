<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // menggunakan model student untuk select data
        $patient = Patient::all();

        $data = [
            'message' => 'Get all patients',
            'data' => $patient
        ];

        return response()->json($data, 200);

        // handling jika data kosong
        if ($patients->isEmpty()) {
            $data = [
                "message" => "Data is empty",
                "data" => []
            ];

            return response()->json($data, 200);
        }

        // handling jika database tidak ada
        else {
            $data = [
                "message" => "Data not found",
                "data" => []
            ];

            return response()->json($data, 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required",
            'phone' => "required",
            'address' => "required",
            'status' => "required",
            'in_date_at' => "required",
            'out_date_at' => "required"
        ]);

        // menangkap data request
        $input = [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status,
            'in_date_at' => $request->in_date_at,
            'out_date_at' => $request->out_date_at
        ];

        // menggunakan model patient untuk insert data
        $patient = Patient::create($input);

        $data = [
            'message' => 'Resource is added successfully',
            'data' => $patient,
        ];

        // mengembalikan data (json) dan kode 201
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // cari id patient yang ingin didapatkan
        $patient = Patient::find($id);

        if ($patient) {
            $data = [
                'message' => 'Get detail resource',
                'data' => $patient,
            ];

            // mengembalikan data (json) dan kode 200
            return response()->json($data, 200);
        }
        else {
            $data = [
                'message' => 'Resource not found',
            ];

            // mengembalikan data (json) dan kode 404
            return response()->json($data, 404);
        }
    }

    /**`
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $patient = Patient::find($id);

        // cek data patient
        if (!$patient) {
            $data = [
                'message' => 'Resource not found'
            ];

            return response()->json($data, 404);
        }

        // menangkap data request
        $input = [
            'name' => $request->input('name', $patient->name),
            'phone' => $request->input('phone', $patient->phone),
            'address' => $request->input('address', $patient->address),
            'status' => $request->input('status', $patient->status),
            'in_date_at' => $request->input('in_date_at', $patient->in_date_at),
            'out_date_at' => $request->input('out_date_at', $patient->out_date_at)
        ];

        // update data
        $patient->update($input);

        $data = [
            'message' => 'Resource is updated successfully',
            'data' => $patient,
        ];

        // mengembalikan data (json) dan kode 200
        return response()->json($data, 200);
        // return response()->json(['message' => 'patient not found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // cari data patients berdasarkan id
        $patient = Patient::find($id);

        // cek data patient
        if (!$patient) {
            return response()->json(['message' => 'Resource not found'], 404);
        }

        // hapus data patient
        $patient->delete();

        $data = [
            'message' => 'Resource is deleted successfully',
        ];

        // mengembalikan data (json) dan kode 200
        return response()->json($data, 200);
    }

    //
    public function search(Request $request, $name)
    {
        $patients = Patient::where('name', 'like', '%' . $name . '%')->get();

        if ($patients->isEmpty()) {
            $data = [
                'message' => 'Resource not found',
            ];
            return response()->json($data, 404);
        }

        $data = [
            'message' => 'Get searched resource: ' . $name,
            'data' => $patients,
        ];

        return response()->json($data, 200);
    }


    //
    public function positive()
    {
    }

    //
    public function recovered()
    {
    }

    //
    public function dead()
    {
    }
}
