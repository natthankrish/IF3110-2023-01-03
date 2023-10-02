<?php

class PhotosView implements ViewInterface
{
    public function render() {
        require_once __DIR__ . '/../../components/user/Photos.php';
    }
}