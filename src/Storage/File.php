<?php

namespace Damoon\Tools\Storage;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class File
{
    protected const TYPES = [
        'mp4' => 'video',
        'webm' => 'video',
        'jpg' => 'image',
        'jpeg' => 'image',
        'png' => 'image',
        'webp' => 'image',
    ];

    public static function upload($file, $path){
        $file = Storage::disk('public')->putFile($path, $file);

        $path = '/upload/'.$file;

        return $path;
    }

    public static function advancedUpload($file, $path){
        $url = self::upload($file, $path);

        return self::fileInfo($url);
    }

    public static function fileInfo(string $url){
        $format = Str::afterLast($url, '.');

        if(isset(self::TYPES[$format])){
            return [
                'url' => $url,
                'type' => self::TYPES[$format],
            ];
        }
        throw new \Exception('فرمت فایل تعریف نشده است');
    }
}
