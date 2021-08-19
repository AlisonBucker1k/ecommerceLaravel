<?php

namespace App;

use App\Enums\CategoryStatus;
use App\Enums\ProductStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'status'];

    protected $dates = ['deleted_at'];

    /**
     * @param mixed $value
     * @return Model|void|null
     */
    public function resolveRouteBinding($value)
    {
        return $this->where('slug', $value)->first() ?? abort(404);
    }

    public function getStatusDescriptionAttribute()
    {
        return CategoryStatus::getDescription($this->status);
    }

    public function getCategoryBySlug($slug)
    {
        return $this->where('slug', $slug)->where('status', CategoryStatus::ACTIVE)->first();
    }

    public function activeCategories()
    {
        return $this->where('status', CategoryStatus::ACTIVE)->get();
    }

    public function products()
    {
        return $this->hasMany('App\Product')->where('status', ProductStatus::ACTIVE)->get();
    }

    public function subcategories()
    {
        return $this->hasMany('App\Subcategory');
    }

    public function save(array $options = [])
    {
        $this->slug = $this->getUniqueSlug($this->name, $this->id);

        return parent::save($options);
    }

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

    public function getTotalProducts(int $categoryId)
    {
        $product = new Product();
        $totalProducts = $product->availableProducts()
            ->where('category_id', $categoryId)
            ->count();

        return $totalProducts;
    }

    public function getCategoriesWithProduct()
    {
        $categories = Category::query()
            ->where('status', CategoryStatus::ACTIVE)
            ->get();

        $returnCategories = [];
        foreach ($categories as $category) {
            $totalProducts = $this->getTotalProducts($category->id);
            if ($totalProducts > 0) {
                $category->subcategories = $category->subcategoriesWithProduct();
                $category->total_products = $totalProducts;
                $returnCategories[] = $category;
            }
        }

        return $returnCategories;
    }

    public function subcategoriesWithProduct()
    {
        $subcategory = new Subcategory();
        $subcategories = $subcategory->getSubcategoriesWithProduct($this->id);

        return $subcategories;
    }
}
