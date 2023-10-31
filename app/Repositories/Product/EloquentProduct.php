<?php

namespace App\Repositories\Product;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Product;
use App\Models\Tag;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EloquentProduct extends EloquentRepository implements BaseRepository, ProductRepository
{
    protected $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function all()
    {

        return $this->model->mine()->with('categories', 'featuredImage', 'image')->get();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function trashOnly()
    {
        if (Auth::user()->isFromPlatform()) {
            return $this->model->onlyTrashed()->with('categories', 'featuredImage')->get();
        }

        return $this->model->mine()->onlyTrashed()->with('categories', 'featuredImage')->get();
    }

    public function store(Request $request)
    {
        $product = parent::store($request);
		
		$this->setAttributes($product, $request->input('variants'));

        if ($request->input('category_list')) {
            $product->categories()->sync($request->input('category_list'));
        }

        if ($request->input('tag_list')) {
			Tag::syncTags($product, $request->input('tag_list'));
        }

        return $product;
    }

    public function update(Request $request, $id)
    {
        $product = parent::update($request, $id);
		
		$this->setAttributes($product, $request->input('variants'));

        $product->categories()->sync($request->input('category_list', []));

		Tag::syncTags($product, $request->input('tag_list', []));

        return $product;
    }

    public function destroy($product)
    {
        if (!$product instanceof Product) {
            $product = parent::findTrash($product);
        }

        $product->detachTags($product->id, 'product');

        $product->flushImages();

        if ($product->hasFeedbacks()) {
            $product->flushFeedbacks();
        }

        return $product->forceDelete();
    }

    public function massDestroy($ids)
    {
        $products = Product::onlyTrashed()->whereIn('id', $ids)->get();

        foreach ($products as $product) {
            $product->detachTags($product->id, 'product');

            $product->flushImages();

            if ($product->hasFeedbacks()) {
                $product->flushFeedbacks();
            }
        }

        return parent::massDestroy($ids);
    }

    public function emptyTrash()
    {
        $products = Product::onlyTrashed()->get();

        foreach ($products as $product) {
            $product->detachTags($product->id, 'product');

            $product->flushImages();

            if ($product->hasFeedbacks()) {
                $product->flushFeedbacks();
            }
        }

        return parent::emptyTrash();
    }
	
	/**
     * Set attribute pivot table for the product variants like color, size and more
     * @param obj $product
     * @param array $attributes
     */
    public function setAttributes($product, $attributes)
    {
        $attributes = array_filter($attributes ?? []);        // remove empty elements

        $temp = [];
        foreach ($attributes as $attribute_id => $attribute_value_id) {
            $temp[$attribute_id] = ['attribute_value_id' => $attribute_value_id];
        }

        if (!empty($temp)) {
            $product->attributes()->sync($temp);
        }

        return true;
    }

    public function getAttributeList(array $variants)
    {
        return Attribute::find($variants)->pluck('name', 'id');
    }

    /**
     * Check the list of attribute values and add new if need
     * @param  [type] $attribute
     * @param  array  $values
     * @return array
     */
    public function confirmAttributes($attributeWithValues)
    {
        $results = [];

        foreach ($attributeWithValues as $attribute => $values) {
            foreach ($values as $value) {
                $oldValueId = AttributeValue::find($value);

                $oldValueName = AttributeValue::where('value', $value)->where('attribute_id', $attribute)->first();

                if ($oldValueId || $oldValueName) {
                    $results[$attribute][($oldValueId) ? $oldValueId->id : $oldValueName->id] = ($oldValueId) ? $oldValueId->value : $oldValueName->value;
                } else {
                    // if the value not numeric thats meaninig that its new value and we need to create it
                    $newID = AttributeValue::insertGetId(['attribute_id' => $attribute, 'value' => $value]);

                    $newAttrValue = AttributeValue::find($newID);

                    $results[$attribute][$newAttrValue->id] = $newAttrValue->value;
                }
            }
        }

        return $results;
    }
}
