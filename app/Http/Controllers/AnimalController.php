<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use Gate;

class AnimalController extends Controller
{

    /**
     * Using 'auth' middleware to restrict access to 
     * routes defined in AnimalController to users that
     * are logged in.
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animals = Animal::all();
        return view('animals.index', ['animals' => $animals]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('isAdmin')) {
            return redirect('animals');
        }

        return view('animals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $animal = $this->validate(request(), [
            'name' => 'required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:1024'
        ]);
        
        if ($request->hasFile('image')) {
            $file_name_plus_ext = $request->file('image')->getClientOriginalName();
            $file_name          = pathInfo($file_name_plus_ext, PATHINFO_FILENAME);
            $extension          = $request->file('image')->getClientOriginalExtension();
            $file_name_to_store = $file_name . '_' . time() . '.' . $extension;
            
            $path = $request->file('image')->storeAs('public/images', $file_name_to_store);
        }
        else {
            $file_name_to_store = "noimage.jpg";
        }

        $animal = new Animal;
        $animal->name        = $request->input('name');
        $animal->DOB         = $request->input('DOB');
        $animal->description = $request->input('description');
        $animal->image       = $file_name_to_store;
        $animal->save();

        return back()->with('success', 'Animal added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('animals.show', [
            'animal' => Animal::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::denies('isAdmin')) {
            return redirect('animals');
        }

        $animal = Animal::find($id);
        return view('animals.edit', compact('animal'));
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
        $animal = Animal::find($id);
        $this->validate(request(), [
            'name' => 'required',
            'DOB' => 'required | date'
        ]);

        $animal->name        = $request->input('name');
        $animal->DOB         = $request->input('DOB');
        $animal->description = $request->input('description');
        $animal->updated_at  = now();

        if ($request->hasFile('image')) {
            $file_name_plus_ext = $request->file('image')->getClientOriginalName();
            $file_name          = pathInfo($file_name_plus_ext, PATHINFO_FILENAME);
            $extension          = $request->file('image')->getClientOriginalExtension();
            $file_name_to_store = $file_name . '_' . time() . '.' . $extension;

            $path = $request->file('image')->storeAs('public/images', $file_name_to_store);
        }
        else {
            $file_name_to_store = 'noimage.jpg';
        }

        $animal->image = $file_name_to_store;
        $animal->save();
        return redirect('animals/' . $id)->with('success', 'Edit successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $animal = Animal::find($id);
        $animal->delete();
        return redirect('animals');
    }
}
