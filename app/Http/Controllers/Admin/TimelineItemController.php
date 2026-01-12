<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTimelineItemRequest;
use App\Models\TimelineItem;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class TimelineItemController extends Controller
{
    public function index(): Response
    {
        $items = TimelineItem::orderBy('order')->paginate(20);

        return Inertia::render('admin/timeline/Index', [
            'items' => $items,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('admin/timeline/Form', [
            'item' => null,
        ]);
    }

    public function store(StoreTimelineItemRequest $request): RedirectResponse
    {
        TimelineItem::create($request->validated());

        return redirect()->route('admin.timeline.index')
            ->with('success', 'Timeline item added successfully.');
    }

    public function edit(TimelineItem $timeline): Response
    {
        return Inertia::render('admin/timeline/Form', [
            'item' => $timeline,
        ]);
    }

    public function update(StoreTimelineItemRequest $request, TimelineItem $timeline): RedirectResponse
    {
        $timeline->update($request->validated());

        return redirect()->route('admin.timeline.index')
            ->with('success', 'Timeline item updated successfully.');
    }

    public function destroy(TimelineItem $timeline): RedirectResponse
    {
        $timeline->delete();

        return redirect()->route('admin.timeline.index')
            ->with('success', 'Timeline item deleted successfully.');
    }
}
