<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Resources\EmployeeResource;
use App\Employee;
use App\Http\Requests;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emp = Employee::all();
        return EmployeeResource::collection($emp);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $emp = new Employee;
        $emp->FirstName = $request->input('FirstName');
        $emp->LastName = $request->input('LastName');
        $emp->Email = $request->input('Email');
        $emp->save();
        return new EmployeeResource($emp);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $emp = new Employee;
        $emp->FirstName = $request->input('FirstName');
        $emp->LastName = $request->input('LastName');
        $emp->Email = $request->input('Email');
        $emp->save();
        return new EmployeeResource($emp);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $article = Employee::find($id); //id comes from route
        if( $article ){
            return new EmployeeResource($article);
        }
        return "Employee Not found"; // temporary error
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $emp = Employee::find($id);
        $emp->FirstName = $request->input('FirstName');
        $emp->LastName = $request->input('LastName');
        $emp->Email = $request->input('Email');
        $emp->save();
        return new EmployeeResource($emp);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $emp = Employee::findOrfail($id);
        if($emp->delete()){
            return  new EmployeeResource($emp);
        }
        return "Error while deleting";
    }
}
