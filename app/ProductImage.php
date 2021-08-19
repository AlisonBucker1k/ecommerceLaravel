<?php

namespace App;

use App\Enums\ProductImageMain;
use App\Enums\UploadPath;
use App\General\Upload;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = ['product_id', 'main', 'file'];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function handleUploadedImages($productId, $images)
    {
        if (empty($images)) {
            return false;
        }

        $existsMainImage = $this->query()->where(['product_id' => $productId, 'main' => ProductImageMain::YES])->exists();

        $count = 0;
        foreach ($images as $image) {
            $main = 0;
            if ($count == 0 && !$existsMainImage) {
                $main = 1;
            }

            $upload = new Upload($image);
            $upload->image_resize = true;
            $upload->image_ratio_fill = true;
            $upload->image_x = 600;
            $upload->image_y = 600;
            $url = $upload->save(UploadPath::PRODUCT_IMAGES);

            $this->newImage($productId, $url, $main);

            $count++;
        }
    }

    public function newImage(int $productId, $url, $main = 0)
    {
        $this->query()->create([
            'product_id' => $productId,
            'main' => $main,
            'file' => $url
        ]);

        return $this;
    }

    public function defineRandomMainImage($productId)
    {
        $image = $this->query()->where('product_id', $productId)->first();
        $image->main = ProductImageMain::YES;
        $image->save();
    }

    public function deleteImage()
    {
        if ($this->main) {
            $this->defineRandomMainImage($this->product_id);
        }

        $this->delete();
    }

    public function defineMainImage()
    {
        $currentMainImage = $this->query()->where(['product_id' => $this->product_id, 'main' => ProductImageMain::YES]);
        $currentMainImage->update(['main' => ProductImageMain::NO]);

        $this->main = ProductImageMain::YES;
        $this->save();
    }

    public function getVariationImage(int $productVariationId)
    {
        return $this->query()
            ->select('product_images.*')
            ->join('product_image_variations', 'product_image_variations.product_image_id', '=', 'product_images.id')
            ->where('product_image_variations.product_variation_id', $productVariationId)
            ->first();
    }

    public function getMainImage(int $productId)
    {
        return $this->query()
            ->where('product_id', $productId)
            ->where('main', ProductImageMain::YES)
            ->first();
    }
}
