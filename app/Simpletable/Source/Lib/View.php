<?php namespace Simpletable\Source;

/**
 * This loads the view by calling the render method and providing
 * name of the view file.
 */
class View
{
    final public function render($name)
    {
        require __DIR__.'/../Views/'.$name.'.php';
    }
}
