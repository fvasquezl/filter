<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;
use Illuminate\Contracts\Auth\Authenticatable;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     * @throws AuthorizationException
     */
    public function index()
    {
        if(Gate::allows('isAdmin') ||Gate::allows('isAuthor') ){
            return  User::latest()->paginate(2);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=> 'required|string|max:191',
            'email'=> 'required|string|email|max:191|unique:users',
            'password'=> 'required|string|min:6',
        ]);
        return User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> Hash::make($request->password),
            'bio'=>$request->bio,
            'photo'=>$request->photo,
            'type'=>$request->type,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return Authenticatable
     */
    public function profile()
    {
        return auth('api')->user();
    }

    public function updateProfile(Request $request)
    {
       $user = auth('api')->user();

        $this->validate($request,[
            'name'=> 'required|string|max:191',
            'email'=> 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password'=> 'sometimes|string|min:6',
        ]);

        $currentPhoto = $user->photo;

       if($request->photo != $currentPhoto){
           $name = time().'.'.explode(
               '/',explode(
                   ':',substr(
                       $request->photo,0,strpos($request->photo,';')
                   )
               )[1]
           )[1];

           Image::make($request->photo)->save(public_path('img/profile/').$name);

           $request->merge(['photo' => $name]);

           $userPhoto = public_path('img/profile/').$currentPhoto;

           //delete the image
           if(file_exists($userPhoto)){
               @unlink($userPhoto);
           }
       }
       if(!empty($request->password)){
           $request->merge(['password' => Hash::make($request->password)]);
       }

       $user->update($request->all());

       return ['success'=>'Success'];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return array
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request,[
            'name'=> 'required|string|max:191',
            'email'=> 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password'=> 'sometimes|string|min:6',
        ]);

        $user->update($request->all());

        return ['message'=>"Updated Users info"];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return array
     * @throws AuthorizationException
     */
    public function destroy($id)
    {
        $this->authorize('IsAdmin');

        $user = User::findOrFail($id);
        $user->delete();
        return ['message'=> 'User Deleted'];
    }


    public function search(Request $request)
    {
        if($search = $request->q){
            $users = User::where(function ($query) use ($search){
               $query->where('name','LIKE',"%$search%")->orWhere('email','LIKE',"%$search%");
            })->paginate(20);
        }else{
            $users = User::latest()->paginate(2);
        }

        return $users;
    }
}
