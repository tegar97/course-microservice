<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MentorController extends Controller
{

    public function index()
    {
        $mentors = Mentor::all();
        return response()->json([
            'status' => 'success',
            'data' => $mentors
        ]);
    }


    public function show($id)
    {
        $mentors = Mentor::find($id);

        if (!$mentors) {
            return response()->json([
                'status' => 'error',
                'data' => 'mentor not found'
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'data' => $mentors
        ]);
    }
    public function create(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'profile' => 'required|url',
            'profession' => 'required|string',
            'email' => 'required|email'
        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }


        $mentor = Mentor::create($data);

        return response()->json(['status' => 'success', 'data' => $mentor]);
    }


    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'string',
            'profile' => 'url',
            'profession' => 'string',
            'email' => 'email'
        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ]);
        }

        $mentor = Mentor::find($id);

        if (!$mentor) {
            return response()->json([
                'status' => 'error',
                'message' => 'mentor not found'
            ]);
        }
        $mentor->fill($data);
        $mentor->save();

        return response()->json([
            'status' => 'success',
            'data' => $mentor
        ]);
    }


    public function destory($id)
    {
        $mentor = Mentor::find($id);
        if (!$mentor) {
            return response()->json([
                'status' => 'error',
                'message' => 'mentor not found'
            ]);
        }

        $mentor->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'mentor deleted'
        ]);
    }
}