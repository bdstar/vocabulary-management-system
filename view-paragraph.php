<?php require "header.php"; ?>

<div class="jumbotron text-center" style="margin-bottom:0">
  <h1> View Passage</h1>
</div>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-12">
        <?php
        if($_GET['id']){ $passage = $obj->fetch("paragraph", array(), array("id"=>$_GET['id'])); ?>
            <h2 class="text-center"><?php echo $passage[0]['name']; ?></h2>
            <p><?php echo $passage[0]['iframe']; ?></p>

            <?php $checker = $obj->PassageChecker($passage[0]['description']); ?>

            <div class="row">
                <div class="col-sm-4 text-left">
                    <?php echo "<strong>Word Count: </strong>".$checker['count']; ?>
                </div>
                <div class="col-sm-4 text-center">
                    <?php echo "<strong>Memorized: </strong>".$checker['memorize']; ?>
                </div>
                <div class="col-sm-4 text-right">
                    <?php echo "<strong>Accuracy: </strong>".$checker['accuracy']."%"; ?>
                </div>
            </div>
            <hr/>
            
            <p class="text-justify"> <?php echo $checker['string']; ?> </p>

        <?php }else{ ?>
            <h2 class="text-center">Invalid Passage Viwe page</h2>
        <?php } ?>
    </div>
  </div>
</div>

<?php require "footer.php"; ?>