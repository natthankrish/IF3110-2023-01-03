<?php

class StorageAccess
{
    private $storageDir;

    public const IMAGE_PATH = 'images';
    public const VIDEO_PATH = 'videos';

    public function __construct($foldername)
    {
        $this->storageDir = __DIR__ . '/../../storage/' . $foldername . '/';
    }

    private function doesFileExist($filename)
    {
        return file_exists($this->storageDir . $filename);
    }

    public function saveVideo($tempname)
    {
        $filesize = filesize($tempname);
        if ($filesize > MAX_SIZE_VIDEO) {
            throw new LoggedException('Request Entity Too Large', 413);
        }

        $mimetype = mime_content_type($tempname);
        if (!in_array($mimetype, array_keys(ALLOWED_VIDEOS))) {
            throw new LoggedException('Unsupported Media Type', 415);
        }

        $valid = false;
        while (!$valid) {
            $filename = md5(uniqid(mt_rand(), true)) . ALLOWED_VIDEOS[$mimetype];
            $valid = !$this->doesFileExist($filename);
        }

        $success = move_uploaded_file($tempname, $this->storageDir . $filename);
        if (!$success) {
            throw new LoggedException('Internal Server Error', 500);
        }

        return $filename;
    }

    public function saveImage($tempname)
    {
        $filesize = filesize($tempname);
        if ($filesize > MAX_SIZE) {
            throw new LoggedException('Request Entity Too Large', 413);
        }

        $mimetype = mime_content_type($tempname);
        if (!in_array($mimetype, array_keys(ALLOWED_IMAGES))) {
            throw new LoggedException('Unsupported Media Type', 415);
        }

        $valid = false;
        while (!$valid) {
            $filename = md5(uniqid(mt_rand(), true)) . ALLOWED_IMAGES[$mimetype];
            $valid = !$this->doesFileExist($filename);
        }

        $success = move_uploaded_file($tempname, $this->storageDir . $filename);
        if (!$success) {
            throw new LoggedException('Internal Server Error', 500);
        }

        return $filename;
    }

    public function deleteFile($filename)
    {
        if (!$this->doesFileExist($filename)) {
            return;
        }

        $success = unlink($this->storageDir . $filename);
        if (!$success) {
            throw new LoggedException('Internal Server Error', 500);
        }
    }
}