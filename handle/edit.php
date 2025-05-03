<?php

require '../App.php';
require_once '../inc/connection.php';


// check method 
if ($request->CheckMethod() == 'POST' && $request->Get('id')) {
    //get data 
    $id = $request->Get('id');

    $selectPrepare = $conn->prepare("select * from `todo` WHERE `id` = :id");
    $selectPrepare->bindParam(":id", $id);
    $selectPrepare->execute();

    if ($selectPrepare->rowCount() == 1) {
        $title = $request->Clean($request->Post('title'));
        //validate data 

        $validation->validate('title', $title, ['Required', 'Str', 'ShortLength']);
        $titleError = $validation->getErrors();
        if(empty($titleError)) {
            $prepare = $conn->prepare("UPDATE `todo` SET `title` = :title WHERE `id` = :id");
            $prepare->bindParam(":title", $title);
            $prepare->bindParam(":id", $id);
            $done = $prepare->execute();
            if ($done) {
                $session->set("success", ["The To Do Updated Successfully"]);
                $request->header('../index.php');
            } else {
                $session->set("error", ["Error While Update ToDo"]);
                $request->header('../index.php');
            }
        }else {
            //else (method) => method not allowed and return to index
            $session->set("titleError", $titleError);
            $request->header("../edit.php?id=$id");
        }

    }else{
        $session->set("error", ['TO Do Not Found']);
        $request->header("../index.php?id=$id");
    }
}
else {
    $request->header('../index.php');
}

    
//good -> insert 

//else -> errors then back to index with error 
