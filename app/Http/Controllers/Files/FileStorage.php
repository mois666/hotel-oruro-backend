<?php

namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use ImageKit\ImageKit;
use ImageKit\Utils\Response;
use Illuminate\Support\Facades\App;

class FileStorage extends Controller
{
    //private const folder_path = 'myfolder';

    public static function path($path)
    {
        return pathinfo($path, PATHINFO_FILENAME);
    }

    public static function upload($fileb64, $folder_path)
    {
        //$file_name = $file->getClientOriginalName();
        //$extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $imageName = time() . '.' . 'png';

        if (env('DIR_PATH_FILE') == 'local') {
            $folderPath = public_path($folder_path);
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }
            try {
                $image_parts = explode(";base64,", $fileb64);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                //$imageName = uniqid() . '.png';
                $imageFullPath = $folderPath . '/' . $imageName;
                file_put_contents($imageFullPath, $image_base64);
                $result = url('/') . '/' . $folder_path . '/' . $imageName;
                return $result;
            } catch (\Exception $e) {
                //return "Error: ".$e->getMessage();
                return "Error33";
            }
        } else if (env('DIR_PATH_FILE') == 'imagekit') {
            //try {
            $imageKit = new ImageKit(
                config('filesystems.imagekit.public_key'),
                config('filesystems.imagekit.private_key'),
                config('filesystems.imagekit.endpoint_url')
            );

            //$contentoBinario = file_get_contents($file);
            //$imageBase64 = base64_encode($contentoBinario);
            //Subiendo a imagekit
            $upload_res = $imageKit->uploadFile([
                'file' => $fileb64, # required, "binary","base64" or "file url"
                'fileName' => $imageName, # required
                'folder' => $folder_path #folder to storage in imagekit
            ]);
            return $upload_res->result->fileId . ',' . $upload_res->result->url;
            // } catch (\Exception $e) {
            //     return "Error33";
            // }
        } else {
            return "Error, no defina su ruta";
        }
    }

    public static function replace($path, $file_id, $image, $folder_path)
    {
        self::delete($path, $file_id);
        return self::upload($image, $folder_path);
    }

    public static function delete($path_url, $file_id)
    {
        if (strpos($path_url, 'https') !== false) {
            if (env('DIR_PATH_FILE') == 'imagekit') {
                $imageKit = new ImageKit(
                    config('filesystems.imagekit.public_key'),
                    config('filesystems.imagekit.private_key'),
                    config('filesystems.imagekit.endpoint_url')
                );

                try {
                    $imageKit->deleteFile($file_id);
                    return "ok";
                } catch (\Exception $e) {
                    return "falla";
                }
            } else {
                return "ok";
            }
        } else {
            $host = url('/');
            $pathFile = substr($path_url, strlen($host) + 1, strlen($path_url));
            if (File::exists(public_path($pathFile))) {
                File::delete(public_path($pathFile));
                return "ok";
            }
            return "falla";
        }
    }
}
