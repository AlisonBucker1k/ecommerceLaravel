<?php

namespace App\General;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Verot\Upload\Upload as VerotUpload;

class Upload extends VerotUpload
{
    public function save($path)
    {
        $file = $this->process();
        $uniqueName = $this->uniqueName($path, $this->file_dst_name_ext);
        $completePath = "$path/$uniqueName";
        Storage::disk('ftp')->put($completePath, $file, 'public');

        return $completePath;
    }

    private function uniqueName($path, $format)
    {
        $name = Str::random() . '.' . $format;
        $exists = Storage::disk('ftp')->exists("$path/$name");
        if ($exists) {
            return $this->uniqueName($path, $format);
        }

        return $name;
    }
}
