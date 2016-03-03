<?php

namespace App\Http\Controllers\Auth;

use App\Domaine;
use App\Http\Request;
use App\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Mail\Mailer;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new authentication controller instance.
     * Utilisation de SWIFT MAILER POUR L'ENVOI DE MAIL
     * GUARD POUR RECUPERER LES DONNES DE L'UTILISATEUR CONNECTE
     * @return void
     */
    public function __construct(Mailer $mailer, Guard $auth)
    {
        $this->mailer = $mailer;
        $this->auth = $auth;
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'domaine_id' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $token = str_random(60);
        $user = User::create([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'confirmation_token' => $token,
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'statut_id' => '1',
            'role_id' => '1',
            'domaine_id' => $data['domaine_id'],
        ]);
        $this->mailer->send('auth.emails.mail', compact('token', 'user'), function($message) use ($user){
            $message->to($user->email)->subject('Confirmation de votre compte');
       });
            return $user;
    }

    protected function Getconfirm($user_id, $token){
        $user = User::findOrFail($user_id);
        if($user->confirmation_token == $token && $user->confirmed == false){
            $user->confirmation_token = null;
            $user->confirmed = true;
            $user->save();
        } else {
            return abort(500);
        }

        $this->auth->login($user);
        return redirect('/')->with('success', 'Votre compte a bien été validé !');
    }

    public function showRegistrationForm() {
        $domaine = Domaine::lists('nom', 'id');
        return view('auth.register', compact('domaine'));
    }
}
