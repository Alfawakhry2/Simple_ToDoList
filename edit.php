<?php
require_once 'inc/header.php';
require_once 'App.php';

if ($request->CheckGet('id')) {
    $id = $request->Get('id');
    $selectPrepare = $conn->prepare("select * from `todo` WHERE `id` = :id");
    $selectPrepare->bindParam(":id", $id);
    $selectPrepare->execute();
    if($selectPrepare->rowCount() > 0){
        $data = $selectPrepare->fetch(PDO::FETCH_ASSOC);
    }else{
        $request->header("index.php");
    }

}
?>

<body class="container w-50 mt-5">
    <form action="handle/edit.php?id=<?=$id?>" method="post">
        <?php
        ?>
            <textarea type="text" class="form-control" name="title" id="" placeholder="enter your note here"><?= @$data['title'] ?></textarea>
        <?php
        ?>
        <div class="text-center">
            <button type="submit" name="edit" class="form-control text-white bg-info mt-3">Update</button>
        </div>
    </form>
    <?php
    if ($session->checkSession('titleError')) {
        foreach ($session->getValue('titleError') as $error) { ?>
            <div class="alert alert-danger"> <?php echo $error ?></div>
        <?php
        }
    }
    $session->emptySession('titleError');
    if ($session->checkSession('success')) {
        foreach ($session->getValue('success') as $success) { ?>
            <div class="alert alert-success"> <?php echo  $success ?></div>
    <?php
        }
        $session->emptySession('success');
    }
    ?>
</body>

</html>