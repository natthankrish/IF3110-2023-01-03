<?php

class ProfileView implements ViewInterface
{
    public function render() {
        require_once __DIR__ . '/../../components/user/Profile.php';
    }
}