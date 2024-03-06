<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse | JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'email'],
            ]);

            if ($validator->fails()) {
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'status' => 'error',
                        'message' => "Terjadi kesalahan validasi",
                        'errors' => $validator->errors(),
                    ], Response::HTTP_UNPROCESSABLE_ENTITY);
                }

                return back()->withErrors($validator)->withInput();
            }

            $status = Password::sendResetLink(
                $request->only('email')
            );

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => $status == Password::RESET_LINK_SENT ? 'success' : 'error',
                    'message' => "Email reset password telah dikirim ke " . $request->email,
                ], Response::HTTP_OK);
            }

            return $status == Password::RESET_LINK_SENT
                ? back()->with('status', __($status))
                : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
        } catch (\Throwable $th) {
            // cek apakah ajax atau membutuhkan response json
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $th->getMessage(),
                    'trace' => $th->getTrace(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            abort(Response::HTTP_INTERNAL_SERVER_ERROR, $th->getMessage());
        }
    }
}
