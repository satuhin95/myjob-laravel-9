<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

 
class ListingController extends Controller
{
    public function index(){
        return view('listings.index',[
            'listings'=> Listing::latest()->filter(request(['tag','search']))->paginate(4)
        ]);

        // return response(Listing::all());
    }

    public function show(Listing $listing){
        return view('listings.show',[
            'listing'=> $listing
        ]);
    }
    public function create(){
        return view('listings.create');
    }
    public function store(Request $request){
        $formFields = $request->validate([
            'title'=>'required',
            'company'=>'required',
            'location'=>'required',
            'website'=>'required',
            'email'=>'required|email',
            'tags'=>'required',
            'description'=>'required'
        ]);
        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos','public');
        }
        $formFields['user_id'] = Auth()->user()->id;
        Listing::create($formFields);

        return redirect('/')->with('message','Listing Created Successfully!');
    }
    public function edit(Listing $listing){
       return view('listings.edit',['listing'=>$listing]);
    }
    public function update(Request $request,Listing $listing){
        $formFields = $request->validate([
            'title'=>'required',
            'company'=>'required',
            'location'=>'required',
            'website'=>'required',
            'email'=>'required|email',
            'tags'=>'required',
            'description'=>'required',
        ]);
        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos','public');
        }
        $listing->update($formFields);

        return redirect('/listing/manage')->with('message','Listing Updated Successfully!');
    }
    public function destroy(Listing $listing){
        $listing->delete();
       return redirect('/listing/manage')->with('message','Listing deleted Successfully!');
    }

    public function manage(){
        return view('listings.manage',['listings'=>auth()->user()->listings()->get()]);
    }
}
