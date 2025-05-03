<?php
require_once "../inc/connection.php";
require_once "../App.php"; 

if($request->CheckGet('id') ){
    $id = $request->Get('id');
    $selectPrepare = $conn->prepare("select * from `todo` WHERE `id` = :id");
    $selectPrepare->bindParam(":id", $id);
    $selectPrepare->execute();
    if($selectPrepare->rowCount() > 0){
        $Prepare = $conn->prepare("DELETE FROM `todo` where `id` =:id");
        $Prepare->bindParam(":id", $id);
        $done=$Prepare->execute();
        if($done){
            $session->set("success" , ['To DO Deleted Successfully']);
            $request->header("../index.php");
        }
    }else{
        $session->set("error" , ['To DO Not Found']);
        $request->header("../index.php");
    }
}else{
    $request->header("../index.php");
}
