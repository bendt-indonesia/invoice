<?php

/**
 * @param string $url
 *
 * @return null
 */
if (!function_exists('delete_file')) {
    function delete_file($url)
    {
        \Illuminate\Support\Facades\Storage::delete('public' . $url);
    }
}


/**
 * @param string $path
 * @param object $file
 * @param string $name
 *
 * @return string
 */
if (!function_exists('save_file')) {
    function save_file($path, $file, $name = null)
    {
        if (is_null($name)) {
            return $file->storeAs('public' . $path);
        } else {
            $file->storeAs('public' . $path, $name);

            return $path . $name;
        }
    }
}