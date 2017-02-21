<?php namespace Simpletable\Source;

/**
 * This controller will get the data from the Model and than display it using the view.
 */
class UserController
{
    public function showView(){
        //Get the results from the DB
        $users = new UserModel;
        $users->getUsers();
        $userList = $users->getResponse();
        //print_r($userList);
        $this->view = new View();
        $this->view->users = $userList;
        $this->view->render('UserView');
    }
}
