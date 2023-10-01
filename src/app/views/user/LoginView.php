<?php

class LoginView implements ViewInterface
{
    public function render() {
        require_once __DIR__ . '/../../components/user/LoginPage.php';
    }
}