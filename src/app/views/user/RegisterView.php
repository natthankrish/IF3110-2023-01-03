<?php

class RegisterView implements ViewInterface
{
    public function render() {
        require_once __DIR__ . '/../../components/user/RegisterPage.php';
    }
}