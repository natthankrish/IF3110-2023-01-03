<?php

class UserDashboardView implements ViewInterface
{
    public function render() {
        require_once __DIR__ . '/../../components/admin/UserDashboard.php';
    }
}