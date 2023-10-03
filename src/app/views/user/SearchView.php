<?php

class SearchView implements ViewInterface
{
    public function render() {
        require_once __DIR__ . '/../../components/user/Search.php';
    }
}