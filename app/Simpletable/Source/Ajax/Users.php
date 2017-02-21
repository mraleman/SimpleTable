<?php namespace Simpletable\Source;

/**
 * This AJAX\User file will handle connect to the Model Class and get
 * the user data or update the user depending on the method requested.
 */
header('Content-Type: application/json');
require_once '..\..\..\init.php';

$u = new UserModel;

if (isset($_POST['method']) && $_POST['method'] == 'init'){
    $u->getUsers();
} elseif (isset($_POST['method']) 
            && $_POST['method'] == 'update'
            && isset($_POST['id']))
{
    $u->updateUser(intval($_POST['id']));
} else {
    $u->setError('Invalid/Missing Parameter');
}

$response = $u->getResponse();
$response['method'] = $_POST['method'];

//send response in JSON
echo json_encode($response);
