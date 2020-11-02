<?php

include('../config.php');
$jdata=json_decode($_POST['temdata']);

if(!$jdata || count($jdata)!=11){
    echo "11 Players Not Selected";
    return;
}
$score = 0;
//$email = $_SESSION['alogin'];
$email="test";
$sql ="INSERT INTO `myteam` ( `useremail`, `p1`, `p2`, `p3`, `p4`, `p5`, `p6`, `p7`, `p8`, `p9`, `p10`, `p11`, `tscore`) VALUES (:email, :p1,:p2,:p3,:p4,:p5,:p6,:p7,:p8,:p9,:p10,:p11,:score)";
$query= $dbh -> prepare($sql);


$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':score', $score, PDO::PARAM_STR);
$empty="";
for($i=0;$i<11;$i++){
    $col=":p".($i+1);
    if($i<count($jdata)){
        $query-> bindParam($col,$jdata[$i]->name, PDO::PARAM_STR);

    }else{
        $query-> bindParam($col,$empty, PDO::PARAM_STR);

    }
}

$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
    echo "Saved Successfully";
}
else
{
    echo "Something went wrong. Please fill and try again";
}

?>