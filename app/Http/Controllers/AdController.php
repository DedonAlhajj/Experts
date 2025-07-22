<?php

namespace App\Http\Controllers;

use App\Exceptions\MediaUploadException;
use App\Http\Requests\AdRequest;
use App\Models\Ad;
use App\Services\AdService;
use Illuminate\Support\Facades\Redirect;

class AdController extends Controller
{
    protected AdService $adService;

    public function __construct(AdService $adService)
    {
        $this->adService = $adService;
    }

    public function index()
    {
        $ads = $this->adService->getPaginatedAds();
        return view('ads.index', compact('ads'));
    }

    public function create()
    {
        return view('ads.create');
    }


    public function store(AdRequest $request)
    {
        try {
            $success = $this->adService->createAd($request->validated());

            return redirect()
                ->route('ads.index')
                ->with($success ? 'success' : 'error', $success ? 'تم إنشاء الإعلان بنجاح' : 'تعذّر إنشاء الإعلان');
        } catch (MediaUploadException $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', "خطأ في رفع الملف: " . $e->getMessage());
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error',  $e->getMessage());
        }
    }

    public function edit(Ad $ad)
    {
        return view('ads.edit', compact('ad'));
    }

    public function update(AdRequest $request, Ad $ad)
    {
        try {
            $success = $this->adService->updateAd($ad, $request->validated());

            return redirect()
                ->route('ads.index')
                ->with($success ? 'success' : 'error', $success ? 'تم تعديل الإعلان بنجاح' : 'تعذّر تعديل الإعلان');
        } catch (MediaUploadException $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', "خطأ في تعديل الصورة: " . $e->getMessage());
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'حدث خلل أثناء تعديل الإعلان، يرجى المحاولة لاحقًا.');
        }
    }

    public function destroy(Ad $ad)
    {
        $success = $this->adService->deleteAd($ad);

        return redirect()
            ->route('ads.index')
            ->with($success ? 'success' : 'error', $success ? 'تم حذف الإعلان' : 'حدث خطأ أثناء حذف الإعلان');
    }


    public function redirectToAd(Ad $ad)
    {
        try {
            $this->adService->registerClick($ad);

            // إن لم يكن للرابط قيمة نوجه لصفحة fallback
            return $ad->link
                ? Redirect::away($ad->link)
                : redirect()->route('ads.index')->with('error', 'Link is not available for this ad.');
        } catch (\Throwable $e) {
            return redirect()
                ->route('ads.index')
                ->with('error', 'Something went wrong while clicking the ad.');
        }
    }
}
