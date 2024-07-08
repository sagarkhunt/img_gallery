<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Get The Image Gallery List Data
     */
    public function index()
    {

        $images = Image::all();
        return view('images.index', compact('images'));
    }
    /**
     * Cerate Image Gallery
     */
    public function create()
    {
        return view('images.create');
    }
    /**
     * Create Image Gallery
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'tag' => 'required|string|max:255',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        Image::create([
            'image_url' => $imagePath,
            'title' => $request->title,
            'description' => $request->description,
            'tag' => $request->tag,
        ]);

        return redirect('/');
    }
    /**
     * Edit Image
     */
    public function edit($id)
    {
        $image = Image::findOrFail($id);
        return view('images.edit', compact('image'));
    }
    /**
     * UPdate Image 
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'tag' => 'required|string|max:255',
        ]);

        $image = Image::findOrFail($id);

        // If a new image is uploaded, process the upload
        if ($request->hasFile('image')) {
            // Store the new image
            $newImagePath = $request->file('image')->store('images', 'public');

            // Delete the old image
            Storage::disk('public')->delete($image->image_url);

            // Update image URL in the database
            $image->image_url = $newImagePath;
        }

        // Update other fields
        $image->title = $request->title;
        $image->description = $request->description;
        $image->tag = $request->tag;
        $image->save();

        return redirect('/');
    }
    /**
     * Show upload form
     */
    public function showUploadForm()
    {
        return view('images.upload');
    }
    /**
     * Upload multiple image on gallery
     */
    public function upload(Request $request)
    {
        $request->validate([
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|string|max:255',
            'tag' => 'required|string|max:255',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $imagePath = $file->store('images', 'public');

                Image::create([
                    'image_url' => $imagePath,
                    'title' => $request->title,
                    'tag' => $request->tag,
                ]);
            }
        }

        return redirect()->route('image.gallery')->with('success', 'Images uploaded successfully.');
    }
    /**
     * Get uploaded image on gallery
     */
    public function showGallery()
    {
        $images = Image::all();
        return view('images.gallery', compact('images'));
    }


    /**
     * Delete Image 
     */
    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        Storage::disk('public')->delete($image->image_url);
        $image->delete();

        return redirect('/')->with('success', 'Image deleted successfully.');
    }
}
