<?php

class HomeView implements ViewInterface
{
    public function render() {
        require_once __DIR__ . '/../../components/home/HomePage.php';
    }
}