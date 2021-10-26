<?php

namespace App\General;

use App\Enums\UploadPath;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Verot\Upload\Upload as VerotUpload;

class Upload extends VerotUpload
{
    public function save($path, $image)
    {
        $uniqueName = $this->uniqueName($path, $image->getClientOriginalExtension());

        $publicPath = Storage::disk('public');

        if ($publicPath->exists("{$path}/{$uniqueName}")) {
            $publicPath->delete("{$path}/{$uniqueName}");
        }
    
        // $file = $this->file;
        $image->storeAs($path, $uniqueName, 'public');

        // ini_set('max_execution_time', 300);

        // $file = $this->process();

        // $uniqueName = $this->uniqueName($path, $this->file_dst_name_ext);

        // Storage::disk('public')->put($path . '/' . $uniqueName, $file);

        return Storage::url($path . '/' . $uniqueName);
    }

    private function uniqueName($path, $format)
    {
        $name = Str::random() . '.' . $format;
        $exists = Storage::disk('public')->exists($path . '/' . $name);
        if ($exists) {
            return $this->uniqueName($path, $format);
        }

        return $name;
    }
}
