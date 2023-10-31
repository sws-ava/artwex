<?php

namespace App\Repositories\Idea;

use App\Models\Idea;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;

class EloquentIdea extends EloquentRepository implements BaseRepository, IdeaRepository
{
    protected $model;

    public function __construct(Idea $idea)
    {
        $this->model = $idea;
    }

    public function all()
    {
        return $this->model->with(
            'subGroup:id,name,idea_group_id,deleted_at',
            'subGroup.group:id,name,deleted_at',
            'featureImage',
            'coverImage'
        )->withCount('ideas', 'listings')->get();
    }

    public function trashOnly()
    {
        return $this->model->onlyTrashed()->get();
    }

    //Create Idea
    public function store(Request $request)
    {	
        $idea = parent::store($request);
		
        if ($request->hasFile('image')) {
            $idea->saveImageTable($request->file('image'), 'ideas', 'image', $idea->id);
        }
		
		return $idea;
    }

    public function update(Request $request, $id)
    {
		$idea = parent::update($request, $id);
		
		if ($request->hasFile('image') || ($request->input('delete_image') == 1)) {
            $idea->deleteImage();
        }

        if ($request->hasFile('image')) {
            $idea->saveImageTable($request->file('image'), 'ideas', 'image', $id);
        }
		
		return $idea;
    }

    public function destroy($id)
    {
        $idea = parent::findTrash($id);

        $idea->flushImages();

        return $idea->forceDelete();
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
