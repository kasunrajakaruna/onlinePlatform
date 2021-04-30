<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\api\DailyCasesController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\DailyCases;
use App\Repositories\User\IUserRepository;
use App\Services\DailyCasesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use App\Models\PassportOAuthClient;
use App\Models\User;
use Auth;
use Log;
use Illuminate\Support\Facades\Session;
use DB;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{

    private $userRepo;

    public function __construct(IUserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    function index()
    {
        if(!Auth::user()){
            return View::make('dashboard');
        }else{
            if(Auth::user()->role == 'admin'){
                return redirect()->route('user_list');
            }else{
                return redirect()->route('ticket_list');
            }
        }        
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    function getTicketList()
    {
        return View::make('manage_tickets.ticket_list');
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    function getUserList()
    {
        $users = $this->userRepo->getAllSupportAgents();
        return View::make('manage_users.user_list', compact('users'));
    }


    /**
     * save new agentr
     * @param Request $request
     * @return $id
     */
    function saveAgent(Request $request)
    {
        $validate = Validator::make($request->input(), array(
            'name' => 'required',
            'password' => 'required',
            'email' => 'required|email'
        ));

        if ($validate->fails()) {
            return array('code' => 400, 'error' => $validate->messages());
        }

        DB::beginTransaction();
        try {

            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->role = 'user';
            $user->save();

            DB::commit();

            return array(
                'code' => 200,
                'reference_no' => $user->id,
                'message' => 'record added successfully'
            );

        } catch (\Exception $e) {
            DB::rollBack();
            log::info($e);
            return array(
                'code' => 401,
                'message' => 'Something went wrong.'
            );
        }

    }

    
    /**
     * login function
     * @param Request $request
     * @return array
     */
    public function login(Request $request)
    {
        try {

            $email = $request->input('email');
            $password = $request->input('password');

            $validate = Validator::make($request->input(), array(
                'email' => 'required',
                'password' => 'required'
            ));

            if ($validate->fails()) {
                return array('code' => 400, 'error' => $validate->messages());
            }

            $user = User::where('email', '=', $email)->first();

            if (empty($user)) {
                return array(
                    'code' => 401,
                    'message' => 'Incorrect Username.'
                );
            }
            if (!Hash::check($password, $user->password)) {
                return array(
                    'code' => 401,
                    'message' => 'Incorrect Password.'
                );
            }

            Auth::login($user, true);

            return array(
                'code' => 200,
                'message' => 'success.'
            );

        } catch (\Exception $e) {

            log::error($e);
            return array(
                'code' => 401,
                'message' => 'Something went wrong.'
            );
        }
    }
    
    /**
     * logout function
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        Session::forget('access_token');
        Auth::logout();
        return redirect('/');
    }

}
