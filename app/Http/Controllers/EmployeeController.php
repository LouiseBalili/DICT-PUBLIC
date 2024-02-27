<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with(['user:id', 'user.roles:id,name'])
            ->paginate(4)
            ->onEachSide(0);
        return inertia('Employee/Index', [
            'employees' => $employees
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Employee/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'id_no' => 'required|unique:employees',
            'fname' => 'required|string',
            'mname' => 'required|string',
            'lname' => 'required|string',
            'address' => 'required|string',
            'emp_type' => 'required|string',
            'status' => 'required|string',
            'role' => 'required|string',
            'photo' => 'image:png,jpeg,jpg|max:2048',
        ]);

        // Create User
        $credentials = [
            'username' => $request->id_no,
            'password' => strtoupper(substr($request->lname, 0, 3)).'_'.$request->id_no
        ];

        $user = User::create([
            'username' => $credentials['username'],
            'password' => bcrypt($credentials['password'])
        ]);

        // Create Employee

        $employee = [
            'id_no' => $request->id_no,
            'fname' => $request->fname,
            'mname' => $request->mname,
            'lname' => $request->lname,
            'address' => $request->address,
            'status' => $request->status,
            'emp_type' => $request->emp_type,
        ];

        if($request->photo) {
            $filename = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('images/profile_pictures'), $filename);
            $employee['profile_photo_path'] = $filename;
        }

        $user->employee()->create($employee);

        // return inertia('Employee/NewEmployee', [
        //     'message' => 'Employee successfully created!',
        //     'credentials' => $credentials
        // ]);

        return redirect(route('employee.index'))->with('success', 'A new employee has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        $credentials = [
            'username' => $employee->id_no,
            'password' => strtoupper(substr($employee->lname, 0, 3)).'_'.$employee->id_no
        ];

        // dd($credentials);
        return inertia('Employee/Credentials', [ 'credentials' => $credentials ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        // dd($employee);
        return inertia('Employee/Edit', [
            'employee' => $employee
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'id_no' => ['required','numeric', Rule::unique(Employee::class)->ignore($employee->id)],
            'fname' => 'required|string',
            'mname' => 'required|string',
            'lname' => 'required|string',
            'address' => 'required|string',
            'emp_type' => 'required|string',
            'status' => 'required|string',
            'role' => 'required|string',
            'photo' => 'image:png,jpeg,jpg|max:2048',
        ]);

        $data = [
            'id_no' => $request->id_no,
            'fname' => $request->fname,
            'mname' => $request->mname,
            'lname' => $request->lname,
            'address' => $request->address,
            'status' => $request->status,
            'emp_type' => $request->emp_type,
        ];

        if($request->photo) {
            $filename = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('images/profile_pictures'), $filename);
            $data['profile_photo_path'] = $filename;
        }

        $employee->update($data);

        return redirect(route('employee.index'))->with('success', 'Employee details successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return back()->with('success', 'Employee has been deleted!');
    }
}
