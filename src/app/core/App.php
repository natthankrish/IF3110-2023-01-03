<?php

class App
{
    protected $controller;
    protected $method;
    protected $params;

    public function __construct()
    {
        require_once __DIR__ . '/../controllers/HomeController.php';
        $this->controller = new HomeController();
        $this->method = 'index';
        $this->params = [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }
}