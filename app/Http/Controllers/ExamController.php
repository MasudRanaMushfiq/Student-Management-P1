<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Student;

class ExamController extends Controller
{
    public function showStudent(Request $request)
    {
        $student = Student::where('student_id', $request->student_id)->first();

        if (!$student) {
            return redirect()->back()->with('error', 'Student not found');
        }

        return view('exam.show', compact('student'));
    }

    public function editStudent($id)
    {
        $student = Student::findOrFail($id);
        return view('exam.edit', compact('student'));
    }

    public function updateStudent(Request $request, $id)
    {
        $request->validate([
            'fullname' => 'required|string|max:255'
        ]);

        $student = Student::findOrFail($id);
        $student->fullname = $request->fullname;
        $student->save();

        return redirect('/exam/student/show?student_id=' . $student->student_id)
            ->with('success', 'Student updated successfully');
    }
}
