<?php

class AdminDashboardView implements ViewInterface
{
    public function render() {
        require_once __DIR__ . '/../../components/admin/AdminDashboard.php';
    }
}