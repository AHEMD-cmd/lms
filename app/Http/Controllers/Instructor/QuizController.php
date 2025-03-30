<?php

namespace App\Http\Controllers\Instructor;

use App\Models\Quiz;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Instructor\Quiz\StoreQuizRequest;
use App\Http\Requests\Instructor\Quiz\UpdateQuizRequest;

class QuizController extends Controller
{
    public function index(Course $course)
    {
        $course->load('sections');
        $sections = $course->sections()->paginate(10);
        return view('instructor.course-quizzes.index', compact('course', 'sections'));
    }

    public function store(StoreQuizRequest $request)
    {
        Quiz::create($request->validated());

        return redirect()->back()->with('message', 'Quiz created successfully');
    }

    public function update(UpdateQuizRequest $request, Course $course, Quiz $quiz)
    {
        $quiz->update($request->validated());

        return redirect()->back()->with('message', 'Quiz Updated successfully');
    }

    public function destroy(Course $course, Quiz $quiz)
    {
        $quiz->delete();

        return redirect()->back()->with('message', 'Quiz deleted successfully');
    }
}
