<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\MyCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MyCourseController extends Controller
{

    public function index(Request $request)
    {
        $MyCourse = MyCourse::query();
        $userId = $request->query('user_id');
        $MyCourse->when($userId, function ($query) use ($userId) {
            return $query;
        });


        return response()->json([
            'status' => 'success',
            'data' => $MyCourse->get()
        ]);
    }
    public function create(Request $request)
    {
        $rules = [
            'course_id' => 'required|integer',
            'user_id' => 'required|integer',

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
            ]);
        }

        $userId = $request->input('user_id');
        $user = getUser($userId);

        if ($user['status'] === 'error') {
            return response()->json([
                'status' => $user['status'],
                'message' => $user['message']
            ], $user['http_code']);
        }

        $isExistMyCourse = MyCourse::where('course_id', '=', $courseId)
            ->where('user_id', '=', $userId)
            ->exists();

        if ($isExistMyCourse) {
            return response()->json([
                'status' => 'error',
                'message' => 'user already taken course '
            ], 409);
        }

        if (!$isExistMyCourse) {
            if ($course->type === 'premium') {

                if ($course->price === 0) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'price cannot be 0'
                    ]);
                }
                $order = postOrder([
                    'user' => $user['data'],
                    'course' => $course->toArray()
                ]);

                // echo "<pre>" . print_r($order, 1) . "<pre>";

                if ($order['status'] === 'error') {
                    return response()->json([
                        'status' => $order['status'],
                        'mesasge' => $order['message']
                    ]);
                }


                return response()->json([
                    'status' => $order['status'],
                    'data' => $order['data']
                ]);
            } else {

                $myCourse = MyCourse::create($data);

                return response()->json([
                    'status' => 'success',
                    'data' => $myCourse
                ]);
            }
        }
    }

    public function createPremiumAccess(Request $request)
    {
        $data = $request->all();
        $MyCourse = MyCourse::create($data);

        return response()->json([
            'status' => 'success',
            'data' => $MyCourse
        ]);
    }
}
