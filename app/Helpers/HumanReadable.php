<?php
/**
 * Created by PhpStorm.
 * User: Sadaf Rana
 * Date: 10/10/2019
 * Time: 10:18 PM
 */

namespace App\Helpers;


class HumanReadable
{
    public static function bytesToHuman($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }
}