<?php

class Controller404 extends Controller
{


    function __construct()
    {
        $this->view = new View();

    }

    function action_index()
    {
        $this->view->setTemplate('404', $this->model);
    }



}