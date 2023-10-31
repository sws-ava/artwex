<?php

namespace App\Repositories\Slider;

use App\Models\Slider;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;

class EloquentSlider extends EloquentRepository implements BaseRepository, SliderRepository
{
    protected $model;

    public function __construct(Slider $slider)
    {
        $this->model = $slider;
    }

    public function all()
    {
        return $this->model->with(
            'subGroup:id,name,slider_group_id,deleted_at',
            'subGroup.group:id,name,deleted_at',
            'featureImage',
            'coverImage'
        )->withCount('products', 'listings')->get();
    }

    public function trashOnly()
    {
        return $this->model->with(
            'subGroup:id,name,slider_group_id,deleted_at',
            'subGroup.group:id,name,deleted_at'
        )->onlyTrashed()->get();
    }

    //Create Slider
    public function store(Request $request)
    {	
        $slider = parent::store($request);
		
        if ($request->hasFile('image')) {
            $slider->saveImageTable($request->file('image'), 'sliders', 'image', $slider->id);
        }
		
		return $slider;
    }

    public function update(Request $request, $id)
    {
		$slider = parent::update($request, $id);
		
		if ($request->hasFile('image') || ($request->input('delete_image') == 1)) {
            $slider->deleteImage();
        }

        if ($request->hasFile('image')) {
            $slider->saveImageTable($request->file('image'), 'sliders', 'image', $id);
        }
		
		return $slider;
    }

    public function destroy($id)
    {
        $slider = parent::findTrash($id);

        $slider->flushImages();

        return $slider->forceDelete();
    }

    public function massDestroy($ids)
    {
        $catSubGrps = $this->model->withTrashed()->whereIn('id', $ids)->get();

        foreach ($catSubGrps as $catSubGrp) {
            $catSubGrp->flushImages();
        }

        return parent::massDestroy($ids);
    }

    public function emptyTrash()
    {
        $catSubGrps = $this->model->onlyTrashed()->get();

        foreach ($catSubGrps as $catSubGrp) {
            $catSubGrp->flushImages();
        }

        return parent::emptyTrash();
    }
}
