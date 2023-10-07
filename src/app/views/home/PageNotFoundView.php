<?php

class PageNotFoundView implements ViewInterface
{
    public function render() {
        require_once __DIR__ . '/../../components/home/PageNotFound.php';
    }
}