<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsletterRequest;
use Illuminate\Http\Request;
use App\Services\NewsletterService;
use App\Rules\ValidEmail;
use Illuminate\Support\Facades\Log;

class NewsletterController extends Controller
{
    public function __construct(protected NewsletterService $newsletter) {}

    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', new ValidEmail($this->newsletter->getValidator())],
        ]);

        $result = $this->newsletter->subscribe($validated['email'], true);

        return redirect()->back()->with(...$result->toFlash());
    }


    public function index(Request $request)
    {
        $subscribers = $this->newsletter->getSubscribers();

        return view('subscribers.index', compact('subscribers'));
    }
    public function indexLetters(Request $request)
    {
        $newsletters = $this->newsletter->getLetters();

        return view('subscribers.indexLetters', compact('newsletters'));
    }
    public function destroy(int $id)
    {
        $result = $this->newsletter->delete($id);

        return redirect()->back()->with(
            $result->success ? 'success' : 'error',
            $result->message
        );
    }

    public function create()
    {
        return view('subscribers.create');
    }

    public function store(StoreNewsletterRequest $request)
    {
        $validated = $request->validated();

        $result = $this->newsletter->store($validated);

        return redirect()->route('newsletters.index')->with(
            $result->success ? 'success' : 'error',
            $result->message
        );
    }

    public function destroyLetters(int $id)
    {
        $result = $this->newsletter->deleteLetters($id);

        return redirect()->back()->with(
            $result->success ? 'success' : 'error',
            $result->message
        );
    }

    public function edit(int $id)
    {
        $newsletter = $this->newsletter->find($id);

        if (! $newsletter) {
            return redirect()->route('newsletters.index')
                ->with('error', 'Newsletter not found.');
        }

        return view('subscribers.edit', compact('newsletter'));
    }

    public function update(StoreNewsletterRequest $request, int $id)
    {
        $data = $request->validated();
        $result = $this->newsletter->update($id, $data);

        return redirect()->route('newsletters.index')->with(
            $result->success ? 'success' : 'error',
            $result->message
        );
    }

    public function send(int $id)
    {
        $result = $this->newsletter->dispatch($id);

        if (! $result) {
            return redirect()->back()->with('error', 'The newsletter could not be sent. Please check if it exists first.');
        }

        return redirect()->back()->with('success', 'The newsletter has been sent successfully.');
    }



}
