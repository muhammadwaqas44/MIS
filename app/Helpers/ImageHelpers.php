<?php
/**
 * Created by PhpStorm.
 * Date: 4/27/18
 * Time: 12:22 PM
 */

namespace App\Helpers;


use Illuminate\Http\Request;
use Image;

class ImageHelpers
{
    public static function updateProfileImage($folderName = "/images/", $file, $fileName)
    {
        Image::make($file)->save(public_path($folderName . $fileName));
    }

    public static function uploadFile($folderName = '/files/' , $file , $fileName){
        $filename = $fileName;

        $destinationPath = public_path($folderName);

        $thisNmae =$file->move($destinationPath,$filename);
//        dd($thisNmae);
    }
}