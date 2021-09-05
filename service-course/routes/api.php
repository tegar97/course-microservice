<?php

use App\Http\Controllers\ChapterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ImageCourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\MyCourseController;
use App\Http\Controllers\ReviewController;
use App\Models\ImageCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('mentors', [MentorController::class, 'create']);
Route::put('mentors/{id}', [MentorController::class, 'update']);
Route::get('mentors', [MentorController::class, 'index']);
Route::get('mentors/{id}', [MentorController::class, 'show']);
Route::delete('mentors/{id}', [MentorController::class, 'destory']);


Route::get('courses', [CourseController::class, 'index']);
Route::get('courses/{id}', [CourseController::class, 'show']);
Route::post('courses', [CourseController::class, 'create']);
Route::put('courses/{id}', [CourseController::class, 'update']);
Route::delete('courses/{id}', [CourseController::class, 'destroy']);

Route::get('chapter', [ChapterController::class, 'index']);
Route::post('chapter', [ChapterController::class, 'create']);
Route::put('chapter/{id}', [ChapterController::class, 'update']);
Route::delete('chapter/{id}', [ChapterController::class, 'destroy']);
Route::get('chapter/{id}', [ChapterController::class, 'show']);

Route::post('lessons', [LessonController::class, 'create']);
Route::put('lessons/{id}', [LessonController::class, 'update']);
Route::get('lessons/', [LessonController::class, 'index']);
Route::get('lessons/{id}', [LessonController::class, 'show']);
Route::delete('lessons/{id}', [LessonController::class, 'destory']);


Route::post('image-course', [ImageCourseController::class, 'create']);
Route::delete('image-course/{id}', [ImageCourseController::class, 'destroy']);

Route::get('my-courses', [MyCourseController::class, 'index']);
Route::post('my-courses', [MyCourseController::class, 'create']);
Route::post('my-courses/premium', [MyCourseController::class, 'createPremiumAccess']);


Route::post('review', [ReviewController::class, 'create']);
Route::put('review/{id}', [ReviewController::class, 'update']);
Route::delete('review/{id}', [ReviewController::class, 'destroy']);
