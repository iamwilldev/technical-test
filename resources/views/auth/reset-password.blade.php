<x-guest-layout>
    @section('Forgot password|' . config('app.name'))

        <div class="card mb-0 shadow-none rounded-0 min-vh-100 h-100">
            <div class="d-flex align-items-center w-100 h-100">
                <div class="card-body">
                    <div class="mb-5">
                        <h2 class="fw-bolder fs-7 mb-1">Reset your password</h2>
                    </div>
                    <!-- Session Status -->

                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <input type="hidden" class="form-control" id="email" aria-describedby="emailHelp"
                            name="email" autofocus required value="{{ old('email', $request->email) }}">

                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="password" aria-describedby="passwordHelp"
                                name="password" autocomplete="new-password" required>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                aria-describedby="passwordHelp" name="password_confirmation" autocomplete="new-password"
                                required>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                        <button type="submit" class="btn btn-primary w-100 py-8 mb-3">Reset Password</button>

                    </form>
                </div>
            </div>
        </div>
    </x-guest-layout>
