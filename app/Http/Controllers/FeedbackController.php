<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFeedbackRequest;
use App\Http\Requests\UpdateFeedbackRequest;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{


    /**
     * GET /dashboard/feedback
     */
    public function index(Request $request)
    {
        $q = $request->input('q');

        $feedback = Feedback::query()
            ->when($q, function ($query) use ($q) {
                $query->where('nama', 'like', "%{$q}%")
                      ->orWhere('email', 'like', "%{$q}%")
                      ->orWhere('pesan', 'like', "%{$q}%");
            })
            ->orderByDesc('tanggal')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('dashboard.feedback', [
            'feedback' => $feedback,
            'q' => $q
        ]);
    }
    
    public function create()
    {
        return view('dashboard.feedback.create');
    }

    public function store(StoreFeedbackRequest $request)
    {
        Feedback::create($request->validated());

        return redirect()
            ->route('home')
            ->with('success', 'Feedback berhasil ditambahkan.');
    }

    public function show(Feedback $feedback)
    {
        return view('dashboard.feedback.show', ['feedback' => $feedback]);
    }

    public function edit(Feedback $feedback)
    {
        return view('dashboard.feedback.edit', ['feedback' => $feedback]);
    }

    public function update(UpdateFeedbackRequest $request, Feedback $feedback)
    {
        $feedback->update($request->validated());

        return redirect()
            ->route('dashboard.feedback.index')
            ->with('success', 'Feedback berhasil diperbarui.');
    }

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        return redirect()
            ->route('dashboard.feedback.index')
            ->with('success', 'Feedback berhasil dihapus.');
    }

    public function detail(Feedback $feedback)
    {
        return view('dashboard.feedback.show', ['feedback' => $feedback]);
    }
}
