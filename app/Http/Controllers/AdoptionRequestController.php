<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\AdoptionRequest;
use App\Models\Animal;
use App\Models\User;
use Gate;

class AdoptionRequestController extends Controller
{
    /**
     * Using 'auth' middleware to restrict access to 
     * routes defined in this controller to users that
     * are logged in.
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource
     * 
     * @return \Illuminate\Http\Response;
     */
    public function index() 
    {
        if (Gate::denies('isAdmin')) {
            return redirect('animals');
        }

        $all_requests = AdoptionRequest::all();
        return view('adoptions.index', compact('all_requests'));
    }

    public function store($animal_id) 
    {        
        $user_id = Auth::user()->id;
        $previous_request = AdoptionRequest::where('user_id', $user_id)->where('animal_id', $animal_id)->get();
        
        if ($previous_request->isEmpty()) {
            $adoption_req = new AdoptionRequest;
            $adoption_req->animal_id = $animal_id;
            $adoption_req->user_id   = $user_id;
            $adoption_req->save();
            
            return back()->with('success', 'Adoption request submitted');
        }
        else {
            $animal_name = Animal::where('id', $animal_id)->value('name');
            return back()->with('failure', 'You have already submitted an adoption request for ' . $animal_name);
        }
    }

    public function showUserRequests() 
    {
        $id = Auth::user()->id;
        
        $user_requests = AdoptionRequest::where('user_id', $id)->get();
        return view('adoptions.show_requests', compact('user_requests'));
    }

    public function showOwners() 
    {        
        if (Gate::denies('isAdmin')) {
            return redirect('adoptions');
        }

        $owners = AdoptionRequest::where('status', 'accepted')->get();
        return view('adoptions.show_owners', compact('owners'));
    }

    public function destroy(Request $request) 
    {
        $id = $request->input('id');
        $adoption_req = AdoptionRequest::find($id);
        $adoption_req->delete();
        return back()->with('success', 'Adoption request cancelled successfully');        
    }

    public function update(Request $request) 
    {
        $id = $request->input('id');
        $req = AdoptionRequest::find($id);

        if ($request->input('action') === 'approve') {

            $req->status = 'accepted';
            $accepted_animal_id = $req->animal->id;
            $accepted_animal = Animal::find($accepted_animal_id);
            $accepted_animal->status = 'unavailable';
            $accepted_animal->save();

            $denied = AdoptionRequest::all()->where('animal_id', $accepted_animal_id)
                                            ->where('user_id', '!=', $req->user->id)
                                            ->where('status', '!=', 'denied');                
            foreach ($denied as $each) {
                $each->status = 'denied';
                $each->save();
            }
        }
        
        if ($request->input('action') === 'deny') {
            $req->status = 'denied';
        }

        $req->save();

        return redirect('adoptions');
    }
}
