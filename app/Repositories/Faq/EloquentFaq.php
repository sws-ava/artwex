<?php

namespace App\Repositories\Faq;

use App\Models\Faq;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;

class EloquentFaq extends EloquentRepository implements BaseRepository, FaqRepository
{
    protected $model;

    public function __construct(Faq $faq)
    {
        $this->model = $faq;
    }

    public function all()
    {
        return $this->model->get();
    }

    public function trashOnly()
    {
        return $this->model->onlyTrashed()->get();
    }

    //Create Faq
    public function store(Request $request)
    {
        $store = parent::store($request);
		
		return $store;
    }

    public function update(Request $request, $id)
    {
        return parent::update($request, $id);
    }

    public function destroy($id)
    {
        $faq = parent::findTrash($id);

        $faq->flushImages();

        return $faq->forceDelete();
    }

    public function massDestroy($ids)
    {
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
