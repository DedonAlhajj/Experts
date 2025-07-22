<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use App\Services\SettingService;
use Illuminate\Http\Request;

// app/Http/Controllers/SettingController.php
class SettingController extends Controller
{

    protected SettingService $settingService;

    public function __construct(SettingService $settingService) {
        $this->settingService = $settingService;
    }

    public function index()
    {
        $settings = $this->settingService->paginate(6);
        return view('settings.index', compact('settings'));
    }

    public function create()
    {
        return view('settings.create');
    }

    public function store(StoreSettingRequest $request)
    {
        try {
            $setting = $this->settingService->store($request->validated());

            return redirect()
                ->route('settings.index')
                ->with('success', "$setting->key Setting Stored successfully ");
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function edit(string $key)
    {
        try {
            $setting = $this->settingService->findByKey($key);
            return view('settings.edit', compact('setting'));
        } catch (\Throwable $e) {
            return redirect()->route('settings.index')->with('error', 'الإعداد المطلوب غير موجود');
        }
    }

    public function update(UpdateSettingRequest $request, string $key)
    {
        try {
            $setting = $this->settingService->update($key, $request->validated());

            return redirect()
                ->route('settings.index')
                ->with('success', "$setting->key Setting updated successfully");
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function destroy(string $key)
    {
        try {
            $this->settingService->delete($key);
            return back()->with('success', 'Setting deleted');
        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}

