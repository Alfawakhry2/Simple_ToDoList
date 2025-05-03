<?php
require_once 'App.php';
require_once 'inc/header.php';
?>

<body>

    <div class="container my-3 ">
        <div class="row d-flex justify-content-center">
            <div class="container mb-5 d-flex justify-content-center">
                <div class="col-md-4">
                    <form action="handle/addToDo.php" method="post">
                        <textarea type="text" class="form-control" rows="3" name="title" id="" placeholder="enter your note here"></textarea>
                        <div class="text-center">
                            <button type="submit" name="add" class="form-control text-white bg-info mt-3 ">Add To Do</button>
                        </div>

                    </form>
                    <br>
                    <?php
                    if ($session->checkSession('titleError')) {
                        foreach ($session->getValue('titleError') as $error) { ?>
                            <div class="alert alert-danger"> <?php echo $error ?></div>
                    <?php
                        }
                    }
                    if ($session->checkSession('error')) {
                        foreach ($session->getValue('error') as $error) { ?>
                            <div class="alert alert-danger"> <?php echo $error ?></div>
                    <?php
                        }
                    }
                    $session->emptySession('titleError');
                    $session->emptySession('error');
                    if($session->checkSession('success')) {
                        foreach ($session->getValue('success') as $success) { ?>
                            <div class="alert alert-success"> <?php echo  $success ?></div>
                    <?php
                        }
                        $session->emptySession('success');
                    }
                    ?>

                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-between">

            <!-- all -->
            <div class="col-md-3 ">
                <h4 class="text-white">All Notes</h4>
                <div class="m-2  py-3">
                    <div class="show-to-do">
                        <?php
                        $prepare = $conn->prepare("select * from `todo` where `status` = 'all' order by `id` desc ");
                        $prepare->execute();
                        if (!($prepare->rowCount() > 0)):
                        ?>
                            <div class="item">
                                <div class="alert-info text-center ">
                                    empty to do
                                </div>
                            </div>
                            <?php
                        else:
                            $all = $prepare->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($all as $a):
                            ?>
                                <div class="alert alert-info p-2">
                                    <h4><?= $a['title'] ?></h4>
                                    <h5><?= $a['created_at'] ?></h5>
                                    <div class="d-flex justify-content-between mt-3">
                                        <a href="edit.php?id=<?= $a['id'] ?>" class="btn btn-info p-1 text-white">edit</a>

                                        <a href="handle/doing.php?status=doing&&id=<?=$a['id']?>" class="btn btn-info p-1 text-white">doing</a>
                                    </div>

                                </div>
                        <?php
                            endforeach;
                        endif;


                        ?>
                    </div>
                </div>

            </div>

            <!-- doing -->
            <div class="col-md-3 ">

                <h4 class="text-white">Doing</h4>

                <div class="m-2 py-3">

                    <div class="show-to-do">
                        <?php
                        $prepare = $conn->prepare("SELECT * FROM `todo` WHERE `status` = 'doing' order by `id` desc");
                        $prepare->execute();
                        if (!($prepare->rowCount() > 0)):
                        ?>

                            <div class="item">
                                <div class="alert-success text-center ">
                                    empty to do
                                </div>
                            </div>
                            <?php
                        else :
                            $doing = $prepare->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($doing as $d):
                            ?>
                                <div class="alert alert-success p-2">
                                    <h4><?= $d['title'] ?></h4>
                                    <h5><?= $d['created_at'] ?></h5>
                                    <div class="d-flex justify-content-between mt-3">
                                        <a></a>
                                        <a href="handle/done.php?status=done&&id=<?=$d['id']?>" class="btn btn-success p-1 text-white">Done</a>
                                    </div>

                                </div>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </div>
                </div>

            </div>

            <!-- done -->
            <div class="col-md-3">
                <h4 class="text-white">Done</h4>

                <div class="m-2 py-3">
                    <div class="show-to-do">
                        <?php
                        $prepare = $conn->prepare("SELECT * FROM `todo` WHERE `status` = 'done'");
                        $prepare->execute();
                        if (!($prepare->rowCount() > 0)):
                        ?>
                            <div class="item">
                                <div class="alert-warning text-center ">
                                    empty to do
                                </div>
                            </div>
                            <?php
                        else :
                            $done = $prepare->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($done as $do):
                            ?>
                                <div class="alert alert-warning p-2">
                                    <a href="handle/delete.php?id=<?=$do['id']?>"  class="remove-to-do text-dark d-flex justify-content-end "><i class="fa fa-close" style="font-size:16px;"></i></a>
                                    <h4><?= $do['title'] ?></h4>
                                    <h5><?= $do['created_at'] ?></h5>

                                </div>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>