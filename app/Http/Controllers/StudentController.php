<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    // Show index page
    public function index()
    {
        return view('students.index');
    }

    // Fetch data for DataTables
    public function getData(Request $request)
{
    $students = Student::orderByDesc('id');

    return datatables()->of($students)
        ->addIndexColumn()
        ->editColumn('name', function($row) {
            $img = $row->image 
                ? '<img src="'.$row->image.'" class="rounded-circle me-2" style="width:40px; height:40px; object-fit:cover;">'
                : '<img src="https://via.placeholder.com/40" class="rounded-circle me-2" style="width:40px; height:40px;">';

            return '<div class="d-flex align-items-center">'.$img.'<span>'.$row->name.'</span></div>';
        })
        ->addColumn('action', function($row) {
            return '
                <button data-id="'.$row->id.'" class="btn btn-sm btn-primary editBtn">Edit</button>
                <button data-id="'.$row->id.'" class="btn btn-sm btn-danger deleteBtn">Delete</button>
            ';
        })
        ->rawColumns(['name', 'action'])   // ✅ ensures HTML is rendered, not escaped
        ->make(true);
}
    // Store student
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|unique:students,student_id|max:13',
            'name'       => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('students', 'public');
        }

        Student::create([
            'student_id' => $validated['student_id'],
            'name'       => $validated['name'],
            'department' => $validated['department'],
            'image'      => $path,
        ]);

        return response()->json(['success' => true]);
    }

    // Edit student (for modal)
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return response()->json($student);
    }

    // Update student
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'student_id' => 'required|max:13|unique:students,student_id,' . $student->id,
            'name'       => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $student->image;
        if ($request->hasFile('image')) {
            if ($student->image) {
                Storage::disk('public')->delete($student->image);
            }
            $path = $request->file('image')->store('students', 'public');
        }

        $student->update([
            'student_id' => $validated['student_id'],
            'name'       => $validated['name'],
            'department' => $validated['department'],
            'image'      => $path,
        ]);

        return response()->json(['success' => true]);
    }

    // Delete student
    public function destroy($id)
    {
        $student = Student::findOrFail($id);

        if ($student->image) {
            Storage::disk('public')->delete($student->image);
        }

        $student->delete();

        return response()->json(['success' => true]);
    }
}
