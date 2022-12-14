<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Country;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
    
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('users.index',compact('data'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country = Country::all();
        return view('users.create',compact('country'));//,compact('roles')
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
             'email' => 'required|email:rfc,dns|unique:users,email',
           'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'country' => 'required',
            'terms' => 'required',
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['username'] = $input['firstname'].$input['lastname'];
    
        $user = User::create($input);
    
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $country = Country::all();
        return view('users.edit',compact('user','country'));
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
        $passwordCheck = $request->input('password') != null;
        
        if(!empty($input['password'])){
            $this->validate($request, [
                'email' => 'required|email|unique:users,email,'.$id,
                'password' => 'required|min:8',
                'password_confirmation' => 'required|same:password',
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'gender' => 'required|in:male,female',
                'country' => 'required',
                'terms' => 'required',
            ]);
        }else{
            $this->validate($request, [
                'email' => 'required|email|unique:users,email,'.$id,
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'gender' => 'required|in:male,female',
                'country' => 'required',
                'terms' => 'required',
            ]);
        }
        
    
        $input = $request->all();

        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }/*else{
           // $input = Arr::except($input,array('password'));    
        }*/
    
        $user = User::find($id);

        $user->update($input);
        
        
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       //echo "hi"; exit;
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
    
}