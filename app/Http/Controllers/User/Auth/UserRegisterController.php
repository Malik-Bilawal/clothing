<?php


    namespace App\Http\Controllers\User\Auth;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use App\Models\User;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Mail;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Log;

    use App\Mail\VerifyEmail;
    
    class UserRegisterController extends Controller
    {

        public function index(){
            return view('user.auth.register');
        }

        public function register(Request $request)
        {
            try {
                $request->validate([
                    'name'     => 'required|string|max:255',
                    'email'    => 'required|email|unique:users,email',
                    'password' => 'required|string|min:6|confirmed',
                ]);
        
                $user = User::create([
                    'name'        => $request->name,
                    'email'       => $request->email,
                    'password'    => Hash::make($request->password),
                    'role'        => User::ROLE_USER,
                    'is_approved' => false,
                ]);
        
                Auth::login($user);
        
                $user->sendEmailVerificationNotification();
                $user->update(['last_verification_sent' => now()]);
        
                return redirect()->route('verification.notice')
                                 ->with('info', 'Please check your email to verify your account.');
        
            } catch (\Exception $e) {
        
                return back()->withInput()->with('error', 'Something went wrong. Please try again.');
            }
        }
        
        
        
    }
        

    
    


