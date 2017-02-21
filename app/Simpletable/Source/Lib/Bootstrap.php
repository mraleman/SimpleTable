<?php namespace Simpletable\Source;

/**
 * Initiates the simple table by calling the controller.
 */
class Bootstrap
{

    public function __construct()
    {
        $controller = new UserController;
        $controller->showView();
    }
}
