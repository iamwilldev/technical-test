<x-guest-layout>
    @section('Forgot password|' . config('app.name'))

        <div class="card mb-0 shadow-none rounded-0 min-vh-100 h-100">
            <div class="d-flex align-items-center w-100 h-100">
                <div class="card-body">
                    <div class="mb-5">
                        <h2 class="fw-bolder fs-7 mb-3">Forgot your password?</h2>
                        <p class="mb-0 ">
                            Please enter the email address associated with your account and We will
                            email you a link to reset your password.
                        </p>
                    </div>
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    <form id="forgotPasswordForm" method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                                name="email" autofocus required value="{{ old('email') }}">
                        </div>

                        <x-input-error :messages="$errors->get('email')" class="mt-2" />

                        <button type="button" onclick="submitForm('#forgotPasswordForm')"
                            class="btn btn-primary w-100 py-8 mb-3">Forgot
                            Password</button>
                        <a href="{{ route('dashboard') }}" class="btn btn-light-primary text-primary w-100 py-8">Back to
                            Login</a>

                    </form>
                </div>
            </div>
        </div>
    </x-guest-layout>
