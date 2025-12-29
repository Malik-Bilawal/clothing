<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSliderController extends Controller
{
    public function index()
    {
        $sliders = HeroSlider::latest()->get();
        return view('admin.hero-slider', compact('sliders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'video' => 'nullable|mimetypes:video/mp4,video/webm,video/ogg|max:51200', // 50MB limit
            'status' => 'required|boolean',
        ]);
    
        if ($request->hasFile('video')) {
            HeroSlider::where('type', 'banner')->delete();
    
            $file = $request->file('video');
            $folder = 'uploads/sliders/videos/';
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $path = $file->storeAs($folder, $filename, 'public');
    
            HeroSlider::create([
                'type' => 'video',
                'title' => $request->title,
                'description' => $request->description,
                'button_text' => $request->button_text,
                'button_url' => $request->button_url,
                'status' => $request->status,
                'video_path' => $path,
            ]);
    
            return redirect()->back()->with('success', 'Video added successfully.');
        }
    
        if ($request->hasFile('image')) {
            HeroSlider::where('type', 'video')->delete();
    
            $file = $request->file('image');
            $folder = 'uploads/sliders/hero_slider/';
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $path = $file->storeAs($folder, $filename, 'public');
    
            HeroSlider::create([
                'type' => 'banner',
                'title' => $request->title,
                'description' => $request->description,
                'button_text' => $request->button_text,
                'button_url' => $request->button_url,
                'status' => $request->status,
                'image' => $path,
            ]);
    
            return redirect()->back()->with('success', 'Banner added successfully.');
        }
    
        return redirect()->back()->with('error', 'Please upload either a video or an image.');
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'video' => 'nullable|mimetypes:video/mp4,video/webm,video/ogg|max:51200',
            'status' => 'required|boolean',
        ]);
    
        $heroSlider = HeroSlider::findOrFail($id);
    
        // 🧩 If updating with a new video
        if ($request->hasFile('video')) {
            // Delete all sliders (since only one video allowed)
            HeroSlider::delete();
    
            $file = $request->file('video');
            $folder = 'uploads/sliders/videos/';
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $path = $file->storeAs($folder, $filename, 'public');
    
            HeroSlider::create([
                'type' => 'video',
                'title' => $request->title,
                'description' => $request->description,
                'button_text' => $request->button_text,
                'button_url' => $request->button_url,
                'status' => $request->status,
                'video' => $path,
            ]);
    
            return redirect()->back()->with('success', 'Hero video updated successfully.');
        }
    
        // 🧩 If updating banner
        if ($request->hasFile('image')) {
            // Delete any video (if exists)
            HeroSlider::where('type', 'video')->delete();
    
            $file = $request->file('image');
            $folder = 'uploads/sliders/hero_slider/';
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $path = $file->storeAs($folder, $filename, 'public');
    
            $heroSlider->update([
                'type' => 'banner',
                'title' => $request->title,
                'description' => $request->description,
                'button_text' => $request->button_text,
                'button_url' => $request->button_url,
                'status' => $request->status,
                'image' => $path,
            ]);
        } else {
            $heroSlider->update([
                'title' => $request->title,
                'description' => $request->description,
                'button_text' => $request->button_text,
                'button_url' => $request->button_url,
                'status' => $request->status,
            ]);
        }
    
        return redirect()->back()->with('success', 'Hero slider updated successfully.');
    }
    
    public function destroy(HeroSlider $heroSlider)
    {
        if ($heroSlider->image && Storage::disk('public')->exists($heroSlider->image)) {
            Storage::disk('public')->delete($heroSlider->image);
        }
        $heroSlider->delete();

        return redirect()->back()->with('success', 'Hero slider deleted successfully.');
    }
}
