<?php

namespace App\Http\Controllers;

use App\Models\Day;
use Illuminate\Http\Request;

class DayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Day::orderBy('created_at', 'asc')->get();  //returns values in ascending order
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [ //inputs are not empty or null
            'startDate' => 'required',
            'noOfDays' => 'required',
        ]);

        $day = new Day;
        $day->startDate = $request->input('startDate'); //retrieving user inputs
        $day->noOfDays = $request->input('noOfDays');  //retrieving user inputs
        $day->save(); //storing values as an object
        return $day; //returns the stored value if the operation was successful.
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Day::findorFail($id); //searches for the object in the database using its id and returns it.
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [ // the new values should not be null
            'startDate' => 'required',
            'noOfDays' => 'required',
        ]);

        $day = Day::findorFail($id); // uses the id to search values that need to be updated.
        $day->startDate = $request->input('startDate'); //retrieves user input
        $day->noOfDays = $request->input('noOfDays'); ////retrieves user input
        $day->save(); //saves the values in the database. The existing data is overwritten.
        return $day; // retrieves the updated object from the database
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $day = Day::findorFail($id); //searching for object in database using ID
        if ($day->delete()) { //deletes the object
            return 'deleted successfully'; //shows a message when the delete operation was successful.
        }
    }
}
