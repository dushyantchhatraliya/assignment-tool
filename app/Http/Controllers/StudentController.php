<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function index()
    {
        $students = User::all();
        return view('student.index',compact('students'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:students,email',
        'age' => 'required|integer|min:1',
        'username' => 'required|string|max:255',
        'class' => 'nullable|string|max:100',
        'performance' => 'nullable|string',
        'attendance' => 'nullable|integer|min:0|max:100',
        'contact' => 'nullable|string|max:20'
    ]);

    $student = Students::create($validated);

    return response()->json(['message' => 'Student created successfully', 'student' => $student], 201);
}

}
