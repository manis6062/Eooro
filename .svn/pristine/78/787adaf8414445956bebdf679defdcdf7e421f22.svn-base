<?php
    if($_POST['id'])
    {   
        DBQuery::execute(function() use ($_POST){
            $id = $_POST['id'];
            $dbObj = DBConnection::getInstance()->getDomain();

            $sql =  $dbObj->prepare("update Review set is_deleted=1 where id=:id");
            $sql->bindParam(':id', $id);
            $sql->execute();
        });
    }


?>


