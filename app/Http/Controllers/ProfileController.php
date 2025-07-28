<?php

namespace App\Http\Controllers;

use App\Exceptions\MediaUploadException;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Services\Profile\ExpertInfoService;
use App\Services\Profile\ProfileService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{

    protected ProfileService $profileService;
    protected ExpertInfoService $expertInfoService;

    public function __construct(
        ProfileService $profileService,
        ExpertInfoService $expertInfoService)
    {
        $this->profileService = $profileService;
        $this->expertInfoService = $expertInfoService;
    }

    /**
     * Displays the profile edit form for the authenticated user.
     *
     * Retrieves the user's profile and expert information using `ExpertInfoService`,
     * and passes the data to the `profile.edit` view.
     *
     * @param Request $request  The incoming HTTP request.
     *
     * @return View|RedirectResponse
     */
    public function edit(Request $request): View|RedirectResponse
    {
        try {
            $data = $this->expertInfoService->getProfileWithExpertInfo($request->user());
            return view('profile.edit', $data);

        } catch (Exception $e) {
            return Redirect::back()->with('error' , $e->getMessage());
        }
    }


    /**
     * Updates the authenticated user's profile information.
     *
     * Validates the incoming request using `ProfileUpdateRequest`,
     * then delegates the update logic to `ProfileService`.
     * Redirects back with success or error feedback.
     *
     * @param ProfileUpdateRequest $request  The validated profile update request.
     *
     * @return RedirectResponse
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse{
        try {
            $this->profileService->update($request->user(), $request->validated());

            return Redirect::route('profile.edit')->with('success', 'تم تحديث الملف الشخصي بنجاح ✅ جاري الآن تحميل صورة الملف الشخصي والسيرة الذاتية في الخلفية... يمكنك الاستمرار بالتصفح، وسيتم ربط الملفات تلقائيًا بمجرد الانتهاء من المعالجة.');
        } catch (MediaUploadException $e) {
            // 🔴 خطأ في رفع الصورة أو الملف
            return back()->with('error' , $e->getMessage());
        } catch (\Throwable $e) {
            return back()->with('error' , $e->getMessage());
        }
    }


    /**
     * Deletes the authenticated user's account.
     *
     * Validates the current password, logs out the user,
     * deletes the account, and invalidates the session.
     *
     * @param Request $request  The incoming HTTP request.
     *
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
