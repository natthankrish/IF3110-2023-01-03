<?php

class PageNotFoundController extends Controller implements ControllerInterface
{
    public function index()
    {
        $notFoundView = $this->view('home', 'PageNotFoundView');
        $notFoundView->render();
    }
}
