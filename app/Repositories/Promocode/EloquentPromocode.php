<?php

namespace App\Repositories\Promocode;

use App\Models\Promocode;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;

class EloquentPromocode extends EloquentRepository implements BaseRepository, PromocodeRepository
{
    protected $model;

    public function __construct(Promocode $promocode)
    {
        $this->model = $promocode;
    }

    public function all()
    {
        return $this->model->with(
            'subGroup:id,name,promocode_group_id,deleted_at',
            'subGroup.group:id,name,deleted_at',
            'featureImage',
            'coverImage'
        )->withCount('products', 'listings')->get();
    }

    public function trashOnly()
    {
        return $this->model->with(
            'subGroup:id,name,promocode_group_id,deleted_at',
            'subGroup.group:id,name,deleted_at'
        )->onlyTrashed()->get();
    }

    //Create Promocode
    public function store(Request $request)
    {
        return parent::store($request);
    }

    public function update(Request $request, $id)
    {
        return parent::update($request, $id);
    }

    public function destroy($id)
    {
        $promocode = parent::findTrash($id);

        $promocode->flushImages();

        return $promocode->forceDelete();
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
