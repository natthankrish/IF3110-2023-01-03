<?php

class UnauthorizedHomeView implements ViewInterface
{
    public function render() {
        require_once __DIR__ . '/../../components/home/UnauthorizedHomePage.php';
    }
}