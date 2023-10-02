<?php

class ManageMyAccountUserView implements ViewInterface
{
    public function render() {
        require_once __DIR__ . '/../../components/user/ManageMyAccount.php';
    }
}