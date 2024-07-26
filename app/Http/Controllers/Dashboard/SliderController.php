<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{




    public function index()
    {
        $sliders = Slider::all();
        return view('dashboard.sliders.index', compact('sliders'));
    }

    public function create()
    {
        $slider = new  Slider();


        return view('dashboard.sliders.create',compact('slider'));
    }

    public function store(Request $request)
    {
        $request->validate(Slider::rules());

        $slider = new Slider();
        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->image = $request->file('image')->store('sliders');

        if ($slider->save()) {
            return redirect()->route('dashboard.sliders.index')->with('success', 'Slider created successfully!');
        } else {
            return redirect()->route('dashboard.sliders.create')->with('error', 'Failed to create slider.');
        }
    }

    public function edit(Slider $slider)
    {
        return view('dashboard.sliders.edit', compact('slider'));
    }



    public function update(Request $request, string $id)
    {
        $request->validate(Slider::rules());

        $slider = Slider::find($id);

        if (!$slider) {
            return redirect()->route('dashboard.sliders.index')->with('error', 'Category not found');
        }

        $old_image = $slider->image;
        $data = $request->except('image');

        $new_image = $this->uploadImage($request);


        if ($new_image) {
            $data['image'] = $new_image;
        }

        $slider->update($data);

        if ($request->hasFile('image')) {
            $slider->image = $request->file('image')->store('sliders');
        }

        if ($old_image && $new_image) {
            try {
                Storage::disk('public')->delete($old_image);
            } catch (\Exception $e) {
                return redirect()->route('dashboard.sliders.index')->with('error', 'Failed to delete old image');
            }
        }

        return redirect()->route('dashboard.sliders.index')->with('success', 'Category updated');
    }




    public function destroy(string $id)
{
    try {
        $slider = Slider::findOrFail($id);

        if ($slider->image) {
            Storage::disk('public')->delete($slider->image);
        }

        // Delete the slider
        $slider->delete();

        return redirect()->route('dashboard.sliders.index')->with('success', 'Slider deleted successfully!');

    } catch (\Exception $e) {

        return redirect()->route('dashboard.sliders.index')->with('error', 'Failed to delete slider.');
    }
}


    protected function uploadImage(Request $request){
        if (!$request->hasFile('image')) {
            return ;
        }

        $file = $request->file('image'); 


                $path = $file->store('sliders');
                $data['image'] = $path;
                return $path;




    }
}
