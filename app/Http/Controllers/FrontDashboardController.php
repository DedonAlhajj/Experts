<?php

namespace App\Http\Controllers;


use App\Services\Profile\ProfileService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Throwable;

class FrontDashboardController extends Controller
{

    protected ProfileService $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }


    /**
     * Displays the homepage with active user statistics and grouped specializations.
     *
     * Retrieves homepage data from `ProfileService` and passes it to the `home` view.
     * If an error occurs, redirects back with an error message.
     *
     * @return View|RedirectResponse
     *@throws Exception|Throwable If data retrieval fails.
     *
     */
    public function home(): View|RedirectResponse
    {
        try {
            $data = $this->profileService->getActiveUsersWithStats();

            return view('home', $data);

        } catch (Exception $ex) {
            return Redirect::back()->with('error', 'Error loading dashboard');
        }
    }

    /**
     * Displays the blog page.
     *
     * Returns the `blog` view. If an error occurs, redirects back with an error message.
     *
     * @throws Exception If view rendering fails.
     *
     * @return View|RedirectResponse
     */
    public function blog(): View|RedirectResponse
    {
        try {

            return view('blog');

        } catch (Exception $ex) {
            return Redirect::back()->with('error', 'Error loading Blog Page');
        }
    }

    /**
     * Displays the contact page.
     *
     * Returns the `contact` view. If an error occurs, redirects back with an error message.
     *
     * @throws Exception If view rendering fails.
     *
     * @return View|RedirectResponse
     */
    public function contact(): View|RedirectResponse
    {
        try {

            return view('contact');

        } catch (Exception $ex) {
            return Redirect::back()->with('error', 'Error loading Contact Page');
        }
    }

}
