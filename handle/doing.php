<?php 

require_once "../App.php";
require_once "../inc/connection.php";
if($request->Get('id') && $request->Get('status')){
    $id = $request->Get('id');
    $status = $request->Get('status');

    $selectPrepare = $conn->prepare("select * from `todo` WHERE `id` = :id");
    $selectPrepare->bindParam(":id", $id);
    $selectPrepare->execute();
    if($selectPrepare->rowCount() == 1){
        $Prepare = $conn->prepare("UPDATE `todo` SET `status` =:st where `id` = :id");
        $Prepare->bindParam(":st", $status);
        $Prepare->bindParam(":id", $id);
        $done=$Prepare->execute(); 
        if($done){
            $session->set("tranfer" , ['To Do add to Doing List']);
            $request->header("../index.php");
        }else{
            $request->header("../index.php");
        }

    }else{
        $request->header("../index.php");
    }

}else{
    $request->header("../index.php");
}
?>