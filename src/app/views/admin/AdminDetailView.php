<?php

class AdminDetailView implements ViewInterface
{
    public function render() {
        require_once __DIR__ . '/../../components/admin/AdminDetail.php';
    }
}