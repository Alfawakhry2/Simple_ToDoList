<?php
require '../App.php';
require_once '../inc/connection.php';


// check method 
if ($request->CheckPost('add') && $request->CheckMethod() == 'POST'){
    //get data 
    $title = $request->Clean($request->Post('title'));

    //validate data 
    // here good but we need to use SOLID Priciples (نخلي كلاس واحد هو الي بيهندل كل دا)
    // echo $required->check('title', $title );
    // echo $str->check('title', $title );
    $validation->validate('title', $title , ['Required' , 'Str' ,'ShortLength']);
    $titleError = $validation->getErrors();
    if(empty($titleError)){
        $prepare = $conn->prepare("INSERT INTO `todo`(`title`) Values(:title)");
        $prepare->bindParam(":title" , $title);
        $done = $prepare->execute();
        if($done){
            $session->set("success" , ["The To Do Added Successfully"]);
            $request->header('../index.php');
        }else{
            $session->set("error" , ["Error While Add ToDo"]);
            $request->header('../index.php');
        }
    }else {
    //else (method) => method not allowed and return to index
    $session->set("titleError" , $titleError);
    $request->header('../index.php');  
}
}else{
    $request->header('../index.php');  
}

//good -> insert 

//else -> errors then back to index with error 
