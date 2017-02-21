<?php namespace Simpletable\Source;

use \PDO;

/**
 * This class gets data and updates user data in the database.
 */
class UserModel
{
    private $_response = ['status'=>true];

    /**
     * Sets the global status response to 'false'
     */
    final public function setError($error)
    {
        $this->_response['status'] = false;
        $this->_response['reason'] = $error;
    }
    /**
     * Method used to process sql statement.
     * Second argument is optional and should be an array with the values as 
     */
    final private function getResults(string $sql,array $params=NULL)
    {
        $results = ['status'=>true,'result'=>[]];

        $conn = new Database;
        $DBH = $conn->connect();

        if (!$DBH) {
            $db_response = $conn->getResponse();
            $results['status'] = false;
            $results['reason'] = 'Database Error: '.$db_response['reason'];
        } else {

            $DBH->beginTransaction();

            try {

                $STH = $DBH->prepare($sql);
                $STH->execute($params);

                //Get the Statement Type.
                $sqlType = explode(' ',$sql,2);
                //Get insert id if this was a new insert statement.
                if ($sqlType[0] == "INSERT") {
                    $insertId = $DBH->lastinsertid();
                    $results['insertId'] = $insertId;           
                //This will return any results if available.
                } elseif ($sqlType[0] == "SELECT") {
                    while ($row = $STH->fetch(PDO::FETCH_ASSOC)) {
                        $results['result'][] = $row;
                    }
                //Return rowCount to know how many rows were updated.
                } elseif ($sqlType[0] == "UPDATE") {
                    $results['rows_affected'] = $STH->rowCount();
                }

                $DBH->commit();

            } catch (\PDOException  $e) {
                $DBH->rollBack();
                $results['status'] = false;
                $results['reason'] = 'Database Error: '.$e->getMessage();
            }
        }

        return $results;
    }
    /**
     * Get the list of users for this table.
     */
    final public function getUsers()
    {
        $params = array();

        $user_sql = 'SELECT * FROM user';
        $rslts = $this->getResults($user_sql);

        if (!$rslts['status']) {
            $this->setError($rslts['reason']);
        } else {
            $this->_response['result'] = $rslts['result'];
        }
    }
    /**
     * Updates the user by increasing the count val by 1
     */
    final public function updateUser($id)
    {
        //basic type validation to determine if an actual int was sent
        if(!is_int($id)){
            $this->setError('Invalid ID');
        }else{

            $now = date("Y-m-d H:i:s");//server time

            $sqlStmnt = 'UPDATE user SET '
                        .'access_count = access_count+1, '
                        .'modify_dt = :modified '
                        .'WHERE user_id = :user_id';

            $params = [
                ':user_id'=>$id,
                ':modified'=>$now
            ];

            $rslts = $this->getResults($sqlStmnt,$params);

            //if update was successful lets return true with id
            if ($rslts['status'] && $rslts['rows_affected']==1) {
                $this->_response['id'] = $id;
                $this->_response['modified'] = date('n/j/y g:ia', strtotime($now));
            } else {
                $this->setError($rslts['reason']);
            }
        }
    }
    /**
     * Public function that should be called at the end to get the response.
     * Response will include a Status Key. If false, it will include 'Reason'
     * A succesful response will include an array in 'Result'.
     */
    final public function getResponse()
    {
        return $this->_response;
    }
}
