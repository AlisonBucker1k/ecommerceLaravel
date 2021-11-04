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
        // ini_set('max_execution_time', 300);

        $file = $this->process();

        $uniqueName = $this->uniqueName($path, $this->file_dst_name_ext);

        Storage::disk('ftp')->put($path . '/' . $uniqueName, $file, 'public');

        return $path . '/' . $uniqueName;
    }

    private function uniqueName($path, $format)
    {
        $name = Str::random() . '.' . $format;
        $exists = Storage::disk('ftp')->exists($path . '/' . $name);
        if ($exists) {
            return $this->uniqueName($path, $format);
        }

        return $name;
    }
}
