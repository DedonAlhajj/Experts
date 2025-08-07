

<form method="POST" class="search-job p-5 bg-white" action="{{ route('password.update') }}">
    @csrf
    @method('PUT')
    <h3 class="h5 text-black mb-4">Update Password</h3>
    <div class="row no-gutters mb-4">
        {{-- 🔒 Current Password --}}
        <div class="col-md mr-md-2">
            <div class="form-group">
                <p class="label-fill">Current Password</p>
                <div class="form-field">
                    <div class="icon"><span class="icon-lock"></span></div>
                    <input type="password"
                           name="current_password"
                           class="form-control"
                           placeholder="Enter current password"
                           autocomplete="off" required>
                </div>
                @error('current_password')
                <p class="text-danger mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <div class="row no-gutters mb-4">
        {{-- 🔑 New Password --}}
        <div class="col-md mr-md-2">
            <div class="form-group">
                <p class="label-fill">New Password</p>
                <div class="form-field position-relative">
                    <div class="icon"><span class="icon-key"></span></div>
                    <input type="password"
                           name="password"
                           id="newPassword"
                           class="form-control"
                           placeholder="Enter new password"
                           autocomplete="new-password">
                    <button type="button" class="toggle-eye" data-target="newPassword">
                        <i class="icon-eye"></i>
                    </button>
                </div>

                @error('password')
                <p class="text-danger mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <div class="row no-gutters mb-4">
        {{-- 🔁 Confirm Password --}}
        <div class="col-md mr-md-2">
            <div class="form-group">
                <p class="label-fill">Confirm Password</p>
                <div class="form-field">
                    <div class="icon"><span class="icon-refresh"></span></div>


                    <input type="password"
                           name="password_confirmation"
                           id="confirmPassword"
                           class="form-control"
                           placeholder="Confirm new password"
                           autocomplete="new-password">
                    <button type="button" class="toggle-eye" data-target="confirmPassword">
                        <i class="icon-eye"></i>
                    </button>

                </div>
                @error('password_confirmation')
                <p class="text-danger mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <button type="submit" class="btn btn-lg btn-primary w-100">
            Save New Password
        </button>

        @if (session('status') === 'password-updated')
            <p class="text-success mt-2">✔️ Password updated successfully!</p>
        @endif
    </div>
</form>

<script>


</script>
