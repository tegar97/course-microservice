<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\ImageCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImageCourseController extends Controller
{
    public function create(Request $request)
    {
        $rules = [
            'image' => 'required|url',
            'course_id' => 'required|integer',

        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $courseId = $request->input('course_id');
        $course = Course::find($courseId);

        if (!$course) {
            return response()->json([
                'status' => 'error',
                'message' => 'course not found'
            ], 404);
        }
        $ImageCourse = ImageCourse::create($data);
        return response()->json([
            'status' => 'success',
            'data' => $ImageCourse
        ]);
    }


    public function destroy($id)
    {
        $ImageCourse =  ImageCourse::find($id);

        if (!$ImageCourse) {
            return response()->json([
                'status' => 'error',
                'message' => 'image not found'
            ], 404);
        }


        $ImageCourse->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'image deleted'
        ]);
    }
}
