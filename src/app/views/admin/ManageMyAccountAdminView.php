<?php

class ManageMyAccountAdminView implements ViewInterface
{
    public function render() {
        require_once __DIR__ . '/../../components/admin/ManageMyAccount.php';
    }
}