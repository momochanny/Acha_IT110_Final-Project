<?php
 
namespace App\Http\Controllers;
 
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use PhpParser\Node\Stmt\TryCatch;

class SocialiteController extends Controller
{
    // Redirect the user to Google's OAuth page
    public function googlelogin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleAuthentication(){

        try{
            
            $googleUser = Socialite::driver('google')->user();


            $user = User::where('google-id', $googleUser->id)->first();
    
            if($user){
                Auth::login($user);
                return redirect()->route('dashboard');
            }else{
               $userData =  User::create([
                   'name' => $googleUser->name,
                   'email' => $googleUser->email,
                   'password' => Hash::make('Password@1234'),
                   'google-id' => $googleUser->id 
                ]);
    
                if($userData){
                    Auth::login($userData);
                    return redirect()->route('dashboard');
                }
            }
        }catch(Exception $e){
            dd($e);
        }


    }
}
