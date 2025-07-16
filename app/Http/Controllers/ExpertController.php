<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpertRequest;
use App\Models\ExpertInfo;
use App\Models\User;
use App\Services\Profile\ExpertInfoService;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ExpertController extends Controller
{

    protected ExpertInfoService $expertInfoService;

    public function __construct(ExpertInfoService $expertInfoService)
    {
        $this->expertInfoService = $expertInfoService;
    }


    /**
     * Displays the expert profile view for a given user.
     *
     * This method retrieves the user's profile and expert information using the ExpertInfoService.
     * If successful, it returns the profile view with the data.
     * If an error occurs, it redirects back with an error message.
     *
     * @param User $user  The user whose expert profile is being displayed.
     *
     * @return \Illuminate\View\View|RedirectResponse
     */
    public function show(User $user): View|RedirectResponse
    {
        try {
            $data = $this->expertInfoService->getProfileWithExpertInfo($user);
            return view('profile.show', $data);

        } catch (Exception $e) {
            return Redirect::back()->with('error' , $e->getMessage());
        }
    }

    /**
     * Store a newly created expert information record for a given user.
     *
     * Authorizes the action, validates the incoming data, delegates
     * the persistence to the ExpertInfoService, and redirects back
     * with a success or error message.
     *
     * @param ExpertRequest $request  The validated request containing expert info data.
     * @param User $user  The user to whom this expert info will be associated.
     * @return RedirectResponse
     *
     * @throws AuthorizationException
     */
    public function store(ExpertRequest $request, User $user): RedirectResponse
    {
        $this->authorize('modifyOwnProfile', $user);
        try {
            $this->expertInfoService->store($request->validated(), $user);
            return Redirect::back()->with('message' ,'Saved successfully') ;

        } catch (Exception $e) {
            return Redirect::back()->with('error' , $e->getMessage());
        }
    }


    public function update(ExpertRequest $request, ExpertInfo $expertInfo): RedirectResponse
    {
        $this->authorize('modifyOwn', $expertInfo);

        try {
            $this->expertInfoService->update($request->validated(), $expertInfo);
            return Redirect::back()->with('message', 'Updated successfully');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'Failed to update Expert Info .');
        }
    }


    public function autocompleteTitles(Request $request): JsonResponse
    {
        $titles = $this->expertInfoService->autocompleteTitles(
            $request->input('category'),
            $request->input('q')
        );

        return response()->json($titles);
    }


}
