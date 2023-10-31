<?php

namespace App\Repositories\Contact;

use App\Models\Contact;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;

class EloquentContact extends EloquentRepository implements BaseRepository, ContactRepository
{
    protected $model;

    public function __construct(Contact $contact)
    {
        $this->model = $contact;
    }

    public function all()
    {
        return $this->model->with(
            'subGroup:id,name,contact_group_id,deleted_at',
            'subGroup.group:id,name,deleted_at',
            'featureImage',
            'coverImage'
        )->withCount('products', 'listings')->get();
    }

    public function trashOnly()
    {
        return $this->model->with(
            'subGroup:id,name,contact_group_id,deleted_at',
            'subGroup.group:id,name,deleted_at'
        )->onlyTrashed()->get();
    }

    //Create Contact
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
        $contact = parent::findTrash($id);

        $contact->flushImages();

        return $contact->forceDelete();
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
