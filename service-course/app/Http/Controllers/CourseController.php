<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Course;
use App\Models\Mentor;

class CourseController extends Controller
{

    public function index(Request $request)
    {
        $course = Course::query();
        $q = $request->query('q');
        $status = $request->query('status');

        $course->when($q, function ($query) use ($q) {
            return $query->whereRaw("name Like '%" . strtolower($q) . "%'");
        });
        $course->when($q, function ($query) use ($status) {
            return $query->where('status', '=', $status);
        });




        return response()->json([
            "status" => 'success',
            'data' => $course->paginate(10)
        ]);
    }
    public function create(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'certificate' => 'required|boolean',
            'thumbnail' => 'string|url',
            'type' => 'required|in:free,premium',
            'status' => 'required|in:draft,published',
            'price' => 'integer',
            'level' => 'required|in:all-level,beginner,intermediate,advance',
            'mentor_id' => 'required|integer',
            'description' => 'string'
        ];


        $data = $request->all();

        $validator = Validator::make($data, $rules);


        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $mentorId = $request->input('mentor_id');
        $mentor = Mentor::find($mentorId);

        if (!$mentor) {
            return response()->json([
                'status' => 'error',
                'message' => 'Mentor Not found'
            ]);
        }


        $course = Course::create($data);

        return response()->json([
            'status' => 'success',
            'data' => $course
        ]);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'string',
            'certificate' => 'boolean',
            'thumbnail' => 'string|url',
            'type' => 'in:free,premium',
            'status' => 'in:draft,published',
            'price' => 'integer',
            'level' => 'in:all-level,beginner,intermediate,advance',
            'mentor_id' => 'integer',
            'description' => 'string'
        ];


        $data = $request->all();

        $validator = Validator::make($data, $rules);


        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $course = Course::find($id);

        if (!$course) {
            return response()->json([
                'status' => "error",
                'message' => 'course not found'
            ]);
        }


        $mentorId = $request->input('mentor_id');

        if ($mentorId) {

            $mentor = Mentor::find($mentorId);
            if (!$mentor) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'mentor not found'
                ]);
            }
        }

        $course->fill($data);

        $course->save();


        return response()->json([
            'status' => 'sukses',
            'data' => $course
        ]);
    }

    public function destroy($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json([
                'status' => 'error',
                'message' => 'course not found'
            ]);
        }

        $course->delete();


        return response()->json([
            'status' => 'sukses',
            'message' => 'course deleted'
        ]);
    }
}
