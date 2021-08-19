<?php

namespace App;

use App\Enums\CategoryStatus;
use App\Enums\SubcategoryStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Subcategory extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'status', 'category_id'];

    protected $hidden = ['updated_at', 'created_at', 'status'];

    protected $dates = ['deleted_at'];

    /**
     * Retrieve the model for a bound value.
     *
     * @param mixed $value
     * @return Model|void|null
     */
    public function resolveRouteBinding($value)
    {
        return $this->where('slug', $value)->first() ?? abort(404);
    }

    /**
     * @return string
     */
    public function getStatusDescriptionAttribute()
    {
        return SubcategoryStatus::getDescription($this->status);
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function getSubCategoryBySlug($slug)
    {
        return $this->where('slug', $slug)->where('status', SubcategoryStatus::ACTIVE)->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ads()
    {
        return $this->hasMany('App\CustomerAd');
    }

    /**
     * @param array $options
     * @return bool
     */
    public function save(array $options = [])
    {
        $this->slug = $this->getUniqueSlug($this->name, $this->id);

        return parent::save($options);
    }

    /**
     * @param $name
     * @param null $id
     * @param int $count
     * @return string
     */
    public function getUniqueSlug($name, $id = null, $count = 0)
    {
        $slug = Str::slug($name, '-');
        if ($count > 0) {
            $slug .= $count;
        }

        $find = $this->query()->where('slug', $slug);
        if (!empty($id)) {
            $find->where('id', '!=', $id);
        }

        $exists = $find->exists();
        if ($exists) {
            return $this->getUniqueSlug($name, $id, $count+1);
        }

        return $slug;
    }

    /**
     * @param int $subcategoryId
     * @return int
     */
    public function getTotalProducts(int $subcategoryId)
    {
        $product = new Product();
        $totalProducts = $product->availableProducts()
            ->where('subcategory_id', $subcategoryId)
            ->count();

        return $totalProducts;
    }

    /**
     * @param $categoryId
     * @return array
     */
    public function getSubcategoriesWithProduct($categoryId)
    {
        $subcategories = $this->query()
            ->where('category_id', $categoryId)
            ->where('status', CategoryStatus::ACTIVE)
            ->get();

        $returnSubcategories = [];
        foreach ($subcategories as $subcategory) {
            $totalProducts = $this->getTotalProducts($subcategory->id);
            if ($totalProducts > 0) {
                $subcategory->total_products = $totalProducts;
                $returnSubcategories[] = $subcategory;
            }
        }

        return $returnSubcategories;
    }
}