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

    public function __construct()
    {
        $this->middleware('ensure.quiz.owner')->except('index', 'store');
    }
    public function index(Course $course)
    {
        $course->load('sections');
        $sections = $course->sections()->paginate(10);
        return view('instructor.course-quizzes.index', compact('course', 'sections'));
    }

    public function store(StoreQuizRequest $request, Course $course)
    {
        Quiz::create($request->validated());

        return redirect()->route('instructor.courses.quizzes.index', $request->course->slug)->with('message', 'Quiz created successfully');
    }

    public function update(UpdateQuizRequest $request, Course $course, Quiz $quiz)
    {
        $quiz->update($request->validated());

        return redirect()->route('instructor.courses.quizzes.index', $course->slug)->with('message', 'Quiz Updated successfully');
    }

    public function destroy(Course $course, Quiz $quiz)
    {
        $quiz->delete();

        return redirect()->route('instructor.courses.quizzes.index', $course->slug)->with('message', 'Quiz deleted successfully');
    }
}
