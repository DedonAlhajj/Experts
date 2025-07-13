<div class="form-group mb-5">
    <h4 class="text-danger mb-2">⚠️ Delete Account</h4>
    <p class="text-muted mb-3">
        Once your account is deleted, all of its resources and data will be permanently removed.
        Please download any data you want to keep before proceeding.
    </p>

    {{-- زر فتح المودال --}}
    <button type="button"
            class="btn btn-outline-danger"
            onclick="document.getElementById('confirm-user-deletion').classList.remove('d-none')">
        Delete Account
    </button>
</div>

{{-- ✨ مودال تأكيد الحذف --}}
<div id="confirm-user-deletion" class="modal-overlay d-none">
    <div class="modal-content p-4">
        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('DELETE')

            <h5 class="text-danger mb-3">Are you sure you want to delete your account?</h5>
            <p class="text-muted mb-4">
                Once deleted, your account and data cannot be restored. Please confirm by entering your password.
            </p>

            {{-- 🔐 كلمة المرور --}}
            <div class="form-group mb-3">
                <p class="label-fill">Password Confirmation</p>
                <div class="form-field">
                    <div class="icon"><span class="icon-lock"></span></div>
                    <input type="password"
                           name="password"
                           class="form-control"
                           placeholder="Enter your password to confirm">
                </div>
                @error('password')
                <p class="text-danger mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- 🎯 أزرار الإجراء --}}
            <div class="d-flex justify-content-end gap-3 mt-4">
                <button type="button" class="btn btn-secondary"
                        onclick="document.getElementById('confirm-user-deletion').classList.add('d-none')">
                    Cancel
                </button>

                <button type="submit" class="btn btn-danger">
                    Permanently Delete
                </button>
            </div>
        </form>
    </div>
</div>

