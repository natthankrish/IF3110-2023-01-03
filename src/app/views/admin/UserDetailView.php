<?php

class UserDetailView implements ViewInterface
{
    public function render() {
        require_once __DIR__ . '/../../components/admin/UserDetail.php';
    }
}