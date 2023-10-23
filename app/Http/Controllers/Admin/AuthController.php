<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ForgotPasswordRequest;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Admin\ResetPasswordRequest;
use App\Jobs\SendForgotPasswordMailJob;
use App\Models\Confirmation;
use App\Models\User;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Hash;

class AuthController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(LoginRequest $request)
    {
        $user = $this->userRepository->findByEmail($request->email);

        if (! $user) {
            return response()->apiError([], __('auth.failed'));
        }

        if (! Hash::check($request->password, $user->password)) {
            return response()->apiError([], __('auth.password'));
        }

        $token = $user->createToken('api')->plainTextToken;

        return response()->apiSuccess(['token' => $token]);
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $user = $this->userRepository->findByEmail($request->email);

        if (! $user) {
            return response()->apiError([], __('auth.failed'));
        }

        try {
            $data = [
                'confirmable_id' => $user->id,
                'confirmable_type' => Confirmation::CONFIRMABLE_TYPE['FORGOT_PASSWORD'],
                'code' => random_int(100000, 999999),
                'expires_at' => Carbon::now()->addMinutes(config('const.auth.forgot_password_time')),
                'name' => $user->name,
                'email' => $user->email,
            ];

            Confirmation::updateOrCreate([
                'confirmable_id' => $user->id,
            ], $data);
            dispatch(new SendForgotPasswordMailJob($data));

            return response()->apiSuccess(true, __('message.admin.success_send_mail'));
        } catch (\Exception $e) {
            logger('SEND_MAIL_ERROR', [$e->getMessage()]);

            return response()->apiError([], __('message.admin.fail_send_mail'));
        }
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $confirmation = Confirmation::where('confirmable_type', Confirmation::CONFIRMABLE_TYPE['FORGOT_PASSWORD'])
            ->where('code', $request->code)->first();

        if (! $confirmation) {
            return response()->apiError([], __('message.admin.fail_reset_password.wrong_code'));
        }

        if ($confirmation->expires_at < Carbon::now()) {
            return response()->apiError([], __('message.admin.fail_reset_password.expire'));
        }

        $user = User::find($confirmation->confirmable_id);

        if (! $user) {
            return response()->apiError([], __('message.admin.fail_reset_password.user_deleted'));
        }
        $user->update([
            'password' => bcrypt($request->password),
        ]);
        $confirmation->delete();

        return response()->apiSuccess(true, __('message.admin.success_reset_password'));
    }
}
