<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use App\Countries;
use App\States;
use App\Cities;
use App\Http\Requests\storeUserProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $users = User::with('profile')->paginate(3);
        return view('admin.customer.index', compact('users'));
    }
    public function trash(){
        $users = User::with('profile')->onlyTrashed()->paginate(3);
        return view('admin.customer.trash', compact('users'));
    }
    public function recoverCustomer($id)
    {
       // $profile = Profile::withTrashed()->where('user_id', $id)->get();
        $profile = Profile::onlyTrashed()->where('user_id', $id)->restore();
        $user = User::onlyTrashed()->find($id)->restore();
      
        
       
        if($user && $profile){
            return back()->with('message', 'User restore successfully');
        }else{
            return back()->with('error', 'Error restoring user');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    
      //  $roles = Role::where('name', '!=', 'admin')->get();
        $countries = Countries::all();
        return view('admin.customer.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeUserProfile $request)
    {
        $user = User::create([
             'name' => $request->name,
             'email' => $request->email,
             'password' => Hash::make($request->password),
             'status' => $request->status,
        ]);
        if($user){
            if($request->has('thumbnail'))
             {
              $extension = ".".$request->thumbnail->getClientOriginalExtension();
              $name = basename($request->thumbnail->getClientOriginalName(), $extension).time();
              $name = $name.$extension;
              $path = $request->thumbnail->storeAs('images/profile', $name, 'public');
              $request->thumbnail = $path;
            }

           $profile =  Profile::create([
                'user_id' => $user->id,
                'address' => $request->address,
                'phone' => $request->contact_no,
                'slug' => $request->slug,
                'thumbnail' =>$request->thumbnail,
                'country_id' => $request->country,
                'state_id' => $request->state,
                 'city_id' => $request->city,
            ]);
        }
        if($user && $profile){
            return back()->with('message', 'User inserted successfully');
        }else{
            return back()->with('error', 'Error inserting user');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $user = User::find($id);
         
          $countries = Countries::all();
          $states = States::all();
          $cities = Cities::all();

          return view('admin.customer.edit', compact('user', 'countries', 'states', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          
           $request->validate([
                 'name' => 'required|max:255',
                 'slug' => 'required|max:255',
                 'address' => 'max:500',
                 'email' => 'email',
                 'contact_no' => 'regex:/^[0-9]{10}$/',
                 'thumbnail' => 'mimes:jpeg,bmp,png|max:2048',
           ]);
          $user = User::find($id);
          $user->name = $request->name;
          $user->email = $request->email;
          $user->status = $request->status;
          $user->profile->slug = $request->slug;
          $user->profile->address = $request->address;
          $user->profile->phone = $request->contact_no;
          $user->profile->country_id = $request->country;
          $user->profile->state_id = $request->state;
          $user->profile->city_id = $request->city;
          if($request->has('thumbnail'))
          {
             $extension = ".".$request->thumbnail->getClientOriginalExtension();
             $name = basename($request->thumbnail->getClientOriginalName(), $extension).time();
             $name = $name.$extension;
             $path = $request->thumbnail->storeAs('images', $name, 'public');
             $user->profile->thumbnail = $path;
          }
          
          if($user->save() && $user->profile->save()){
              return back()->with('message', 'Profile updated successfully');
          }else{
              return back()->with('error', 'Error updating profile');
          }
          
           
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::onlyTrashed()->find($id)->forceDelete();
        $profile = Profile::onlyTrashed()->where('user_id', $id)->forceDelete();
        if($user && $profile)
        {
            return response()->json(['status' => 'User Deleted successfully']);
        }else{
            return response()->json(['status' => 'Error Deleting user']);
        }
    }
    // remove will throw in trash

    public function remove($id){
         $user = User::find($id);
         if($user->delete() && $user->profile->delete()){
            return back()->with('message', 'User removed successfully');
         }else{
             return back()->with('error', 'Error removing the user');
         }
    }
    public function state(Request $request, $id){
        if($request->ajax()){
           
           return States::where('country_id', '=', $id)->get();
        }
        else{
            return 0;
        }
    }
    public function cities(Request $request, $id){
        if($request->ajax()){
            $cities = Cities::where('state_id', '=', $id)->get();
            return $cities;
        }
        else{
            return 0;
        }
    }
}
