<?php
    //user variable where data will be loaded to from the controller
    $this->users;

    if (!isset($this->users)) $this->users = 
        [
            'status'=>false,
            'reason'=>'No Records Found',
            'result'=>[]
        ];

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Simple Interactive Table</title>
<link rel="stylesheet" type="text/css" href="includes/css/styles.css">
<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
<script type="text/javascript" src="includes/js/users.js"></script>
</head>
<body>
<div>
    <header>
        <h1>NiVR&Lambda;M&Lambda;</h1>
    </header>
    <section>
        <h2>Simple Interactive Table</h2>
        <p>This is a simple interactive table written in PHP, jQuery, HTML5, CSS3 and uses MySQL as the datastore.<br>Click on the button and the Count value will increment by 1 while the Last Modified Date will change.  This solution uses simple MVC, AJAX and Responsive Design/Developement.<br>Sample Code available at <a href='https://github.com/mraleman/SimpleTable' target="_blank">Github</a></p>
        <!--Begin Table-->
        <ul>
            <li>
                <ul>
                    <li>ID</li>
                    <li>Name</li>
                    <li>Count</li>
                    <li>Last Modified</li>
                    <li>&nbsp;</li>
                </ul>
            </li>
            <?php
                if ($this->users['status']) {
                    $result = $this->users['result'];
                    for($i=0;$i<count($result);$i++) {
                       $row = ($i%2)==1?'':' class=row';;
            ?>
            <li<?php echo $row; ?>>
                <ul>
                    <li><?php echo $result[$i]['user_id']; ?></li>
                    <li><?php echo $result[$i]['name']; ?></li>
                    <li><?php echo $result[$i]['access_count']; ?></li>
                    <li><?php
                            if (is_null($result[$i]['modify_dt'])) {
                                $lm = "";
                            } else {
                                $rawtime = strtotime($result[$i]['modify_dt']);
                                $lm = date('n/j/y g:ia',$rawtime);
                            }
                            
                            echo $lm; 
                        ?></li>
                    <li><button id="<?php echo $result[$i]['user_id']; ?>">Click</button></li>
                </ul>
            </li>
            <?php
                    }
                } else {
            ?>
            <li><h3><?php echo $this->users['reason']; ?></h3></li>
            <?php
                }
            ?>
        </ul>
        <!--End Table-->
    </section>
</div>
</body>
</html>
