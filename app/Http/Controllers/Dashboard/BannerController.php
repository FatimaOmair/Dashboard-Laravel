<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('dashboard.banners.index', compact('banners'));
    }

    public function create()
    {
        $banner = new  Banner();

        return view('dashboard.banners.create',compact('banner'));
    }

    public function store(Request $request)
    {
        $request->validate(Banner::rules());


        $data = $request->except('image');
        $data['image'] = $this->uploadImage($request);

        Banner::create($data);

        return redirect()->route('dashboard.banners.index')->with('success', 'banner created');

    }

    public function show(Banner $banner)
    {
        return view('dashboard.banners.index', compact('banner'));
    }



    public function edit(string $id)
    {
        try {
            // Fetch the banner to be edited
            $banner = Banner::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route('dashboard.banners.index')->with('error', 'Banner not found');
        }


        return view('dashboard.banners.edit', compact('banner'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate(Banner::rules());

        $banner = Banner::find($id);

        if (!$banner) {
            return redirect()->route('dashboard.banners.index')->with('error', 'Banner not found');
        }

        $old_image = $banner->image;
        $data = $request->except('image');

        $new_image = $this->uploadImage($request);


        if ($new_image) {
            $data['image'] = $new_image;
        }

        $banner->update($data);

        if ($request->hasFile('image')) {
            $banner->image = $request->file('image')->store('banners');
        }

        if ($old_image && $new_image) {
            try {
                Storage::disk('public')->delete($old_image);
            } catch (\Exception $e) {
                return redirect()->route('dashboard.banners.index')->with('error', 'Failed to delete old image');
            }
        }
        return redirect()->route('dashboard.banners.index')->with('success', 'Banner updated');
    }

    public function destroy(string $id)
    {
        try {
            $banner = Banner::findOrFail($id);

            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }

            // Delete the banner
            $banner->delete();

            return redirect()->route('dashboard.banners.index')->with('success', 'Banner deleted successfully!');

        } catch (\Exception $e) {

            return redirect()->route('dashboard.banners.index')->with('error', 'Failed to delete banner.');
        }
    }

    protected function uploadImage(Request $request){
        if (!$request->hasFile('image')) {
            return ;
        }

        $file = $request->file('image');


                $path = $file->store('banners');
                $data['image'] = $path;
                return $path;




    }
}
