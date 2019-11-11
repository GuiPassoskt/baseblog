<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FilesController extends Controller
{
    public function index(Request $request)
    {
        $basepath = storage_path('app/public/');

        $path = $basepath;

        if ($request->has('path'))
        {
            $path .= rtrim($request->get('path'), '/') . '/';
        }

        $files = array_map(function ($file) use($path, $basepath) {

            $result = [
                'type' => filetype($file),
                'name' => str_replace($path, '', $file),
            ];

            if (is_file($file)) {
                $result['url'] = url(\Storage::url(str_replace($basepath, '', $file)));
            }

            return $result;

        }, glob($path . '*'));


        return [
            'files' => $files,
            'relative_path' => str_replace($basepath, '', $path),
        ];
    }


    public function upload(Request $request)
    {
        $this->validate($request, [
            'path' => 'nullable|string',
            'file' => 'required|image'
        ]);

        $file = $request->file('file')->store($request->path, [
            'disk' => 'public'
        ]);


        return $file;
    }
}
