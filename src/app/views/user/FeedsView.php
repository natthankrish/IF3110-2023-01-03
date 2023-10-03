<?php

class FeedsView implements ViewInterface
{
    public function render() {
        require_once __DIR__ . '/../../components/user/Feeds.php';
    }
}