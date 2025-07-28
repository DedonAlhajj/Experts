<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\AdService;
use App\Services\Profile\ProfileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class UserController extends Controller
{

    protected ProfileService $profileService;
    protected AdService $adService;

    public function __construct(ProfileService $profileService,AdService $adService)
    {
        $this->adService = $adService;
        $this->profileService = $profileService;
    }



    /**
     * Filters expert users by specialization and optional location or name.
     *
     * Uses `ProfileService` to retrieve filtered expert users based on the provided title,
     * location, and name. Returns the `expert-by-specialization` view with the results.
     *
     * @param Request $request  The incoming HTTP request containing filters.
     * @param string $title  The specialization title to filter by.
     *
     * @return View|RedirectResponse
     */
    public function filterBySpecialization(Request $request): View|RedirectResponse
    {
        $title = strtolower($request->query('title'));

        try {
            $location = $request->input('location');
            $name = $request->input('name');
            $ads = $this->adService->getVisibleAdsGroupedByPosition();
            $experts = $this->profileService->filterUserBySpecialization(
                location: $location,
                title: $title,
                name: $name
            );

            return view('expert-by-specialization', compact('experts', 'ads','title', 'location', 'name'));

        } catch (\Throwable $e) {

            return Redirect::back()->with('error', $e->getMessage());
        }
    }




    /**
     * Retrieves all expert users based on optional filters.
     *
     * Uses `ProfileService` to fetch expert users filtered by title, location, and name.
     * Returns the `expert` view with the results.
     *
     * @param Request $request  The incoming HTTP request containing filters.
     *
     * @return View|RedirectResponse
     */
    public function getExperts(Request $request): View|RedirectResponse
    {
        try {
            $title = $request->input('title');
            $location = $request->input('location');
            $name = $request->input('name');
            $ads = $this->adService->getVisibleAdsGroupedByPosition();
            $experts = $this->profileService->getExperts($location, $title,$name);

            return view('expert', compact('experts','ads','title','location','name'));

        } catch (\Throwable $e) {

            return Redirect::back()->with('error', $e->getMessage());
        }
    }


    /**
     * Retrieves a paginated list of job seekers based on optional filters.
     *
     * Uses `ProfileService` to fetch users marked as job seekers and active.
     * Filters include location, title, and name.
     *
     * @param Request $request  The incoming HTTP request containing filters.
     *
     * @return View|RedirectResponse
     */
    public function getJobSeeker(Request $request): View|RedirectResponse
    {
        try {
            $title = $request->input('title');
            $location = $request->input('location');
            $name = $request->input('name');
            $ads = $this->adService->getVisibleAdsGroupedByPosition();
            $getJobSeeker = $this->profileService->getJobSeeker($location, $title,$name);
            return view('job_seeker', compact('getJobSeeker','ads','title','location','name'));

        } catch (\Throwable $e) {

            return Redirect::back()->with('error', $e->getMessage());
        }
    }


    /**
     * Retrieves a paginated list of inactive users based on optional filters.
     *
     * Uses `ProfileService` to fetch users marked as inactive.
     * Filters include location, title, and name.
     *
     * @param Request $request  The incoming HTTP request containing filters.
     *
     * @return View|RedirectResponse
     */
    public function inactiveUsers(Request $request): View|RedirectResponse
    {
        try {
            $title = $request->input('title');
            $location = $request->input('location');
            $name = $request->input('name');
            $inactiveUsers = $this->profileService->inactiveUsers($location, $title,$name);
            return view('inactiveUsers', compact('inactiveUsers','title','location','name'));

        } catch (\Throwable $e) {

            return Redirect::back()->with('error', $e->getMessage());
        }
    }


    /**
     * Toggles the activation status of a user.
     *
     * Flips the `is_active` flag and returns a success message.
     * Uses `ProfileService` to perform the update.
     *
     * @param User $user  The user whose activation status will be toggled.
     *
     * @return RedirectResponse
     */
    public function toggleActivation(User $user): RedirectResponse
    {
        try {
            $message = $this->profileService->toggleActivation($user);
            return Redirect::back()->with('success', $message);

        } catch (\Throwable $e) {

            return Redirect::back()->with('error', $e->getMessage());
        }
    }


    /**
     * Retrieves a list of specializations with their occurrence count.
     *
     * Uses `ProfileService` to fetch grouped specializations.
     * Optionally filters by title.
     *
     * @param Request $request  The incoming HTTP request containing filters.
     *
     * @return View|RedirectResponse
     */
    public function getSpecializations(Request $request): View|RedirectResponse
    {
        try {

            $title = $request->input('title'); // null إذا لم يُرسل شيء

            $specializations = $this->profileService->getSpecializationsAndTheirNumber(
                limit: null,
                title: $title
            );
            $ads = $this->adService->getVisibleAdsGroupedByPosition();

            return view('specializations', compact('specializations', 'title','ads'));


        } catch (\Throwable $e) {

            return Redirect::back()->with('error', $e->getMessage());
        }
    }

    public function suggestCountries(Request $request)
    {
        $search = strtolower($request->query('query'));

        $countries = DB::table('users')
            ->select('country')
            ->whereNotNull('country')
            ->where('country', 'LIKE', "%{$search}%")
            ->distinct()
            ->limit(10)
            ->pluck('country');

        return response()->json($countries);
    }
}
