<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Admin;
use App\Entities\Log;
use App\Events\SendMailWhenUserLoginEvent;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('backend.auth.login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'), $request->get('remember'))) {

            /** @var Admin $userLogin */
            $userLogin = Auth::guard('admin')->user();

            DB::table('logs')->insert([
                'name' => 'Đăng nhập hệ thống',
                'content' => sprintf('ip: %s <br/> Trình duyệt: %s', $request->ip(), $request->userAgent()),
                'action' => Log::ACTION_LOGIN,
                'created_by' => $userLogin->id,
            ]);

            event(new SendMailWhenUserLoginEvent($userLogin));

            return redirect()->intended(admin_route('home.index'));
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->regenerate();
        return $this->loggedOut($request) ?: redirect()->guest(admin_route('login'));
    }

    /**
     * Nếu nhảy vào 1 link yêu cầu đăng nhập trong khi chưa login, chuyển hướng về trang đăng nhập
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function loggedOut()
    {
        return redirect()->guest(admin_route('login'));
    }
}
