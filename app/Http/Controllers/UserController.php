<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function uploadAvatar(Request $request)
    {
        if($request->hasFile('image'))
        {
            User::uploadAvatar($request->image);
            // $request->session()->flash('message','image uploaded.');
            // return redirect()->back();  //success message
            
            return redirect()->back()->with('message','image uploaded.');  //success message
            // $filename = $request->image->getClientOriginalName();
            // $this->deleteOldImage();
            // //$request->image->store('images','public');
            // //User::find(1)->update(['avatar'=>$filename]);

            // $request->image->storeAs('images',$filename,'public');
            // auth()->user()->update(['avatar'=>$filename]);
        }
        //$request->session()->flash('error','image not uploaded.');
        //return redirect()->back();   // error message
        return redirect()->back()->with('error','image not uploaded.');
    }
    //


    public function index()
    {
        $data = [
            'name' => 'Elon2',
            'email'=> 'elon2@gmail.com',
            'password'=> 'hin123',
        ];
        //User::create($data);
        // $user = new User();
        // $user->name = 'hinhin';
        // $user->email = 'hin85131@gmail.com';
        // $user->password = bcrypt('hin123');
        // $user->save();

        //dd($user);

        //User::where('id',4)->update(['name'=>'hinhinsdasdsadasd']);

         $user = User::all();
         return $user;

        //User::where('id',2)->delete();
        
        //return 'I am in User Controller';
        //DB::insert('insert into users (name,email,password) values (?,?,?)',['hin','hin850131@gmail.com','hin123']);
        /* $users = DB::select('select * From users');
        return $users; */
        //DB::update('update users set name = ? where id = 1',['hinhin']);
        /* DB::delete('delete from users where id=1');
        $users = DB::select('select * From users');
        return $users; */
        return view("home");
    }

    
}
