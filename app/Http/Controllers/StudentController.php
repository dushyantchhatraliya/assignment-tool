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
            'student_name' => 'required|string|max:255|regex:/^[A-Za-z\s\.]+$/',
            'date_of_birth' => 'required|date|before:' . now()->subYears(5)->toDateString(),
            'contact' => 'required|min:10|max:10',
            'class' => 'required|integer|between:1,12',
            'performance' => 'required|numeric|min:0|max:100',
            'attendance' => 'required|numeric|min:0|max:100',
            'address' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'student_email' => 'nullable|string|email|max:255|unique:students',
        ]);

        Students::create($validated);
    
        return response()->json(['message' => 'Student added successfully.']);
    }
    
    public function studentGet(Request $request)
    {
        $query = Students::query();
    
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('student_name', 'like', "%{$search}%")
                  ->orWhere('contact', 'like', "%{$search}%")
                  ->orWhere('student_email', 'like', "%{$search}%"); // make sure email field exists
            });
        }
    
        $students = $query->orderBy('id', 'desc')->paginate(10);
    
        return response()->json([
            'data' => $students->items(),
            'pagination' => [
                'current_page' => $students->currentPage(),
                'last_page' => $students->lastPage(),
                'per_page' => $students->perPage(),
                'total' => $students->total(),
            ]
        ]);
    }
    
    
}
