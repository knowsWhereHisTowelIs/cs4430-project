<?php

namespace cs4430;

class Files {

    public static function fileExtension($filename) {
        $path_info = pathinfo($filename);
        if (isset($path_info['extension'])):
            return $path_info['extension'];
        else:
            return false;
        endif;
    }

    public static function scandirSortedFilesFirst($path) {
        $sortedData = array();
        $files = @scandir($path);
        if (is_array($files)) {
            foreach ($files as $file) {
                if (is_file($path . $file)) {
                    array_unshift($sortedData, $file);
                } else {
                    array_push($sortedData, $file);
                }
            }
        }
        return ( $sortedData );
    }

    public static function scandirSortedFoldersFirst($path) {
        $sortedFolders = array();
        $sortedFiles = array();

        $rawFiles = @scandir($path);
        if (is_array($rawFiles)) {
            sort($rawFiles);
            foreach ($rawFiles as $file) {
                if (is_file($path . $file)) {
                    $sortedFiles[] = $file;
                } else {
                    $sortedFolders[] = $file;
                }
            }
        }
        return array_merge($sortedFolders, $sortedFiles);
    }

    public static function includeFilesRecursively(string $directory, $scanDirCallback = null) {
        if( $scanDirCallback === null ) {
            $scanDirCallback = [__CLASS__, 'scandirSortedFilesFirst'];
        }
        if( substr($directory, -1) !== '/' ) {
            $directory .= '/';
        }
        $fileList = call_user_func($scanDirCallback, $directory);
        foreach ($fileList as $key => $file) {
            if ( ! in_array($file, ['.', '..']) ) {
                $extension = self::fileExtension($file);
                $filename = $directory . $file;
                if ( $extension === "php") {
                    require_once( $filename );
                } elseif (is_dir($filename)) {
                    //directory
                    self::includeFilesRecursively($filename . '/', $scanDirCallback);
                } else {
                    //not php file don't touch
                }
            }
        }
    }
}
