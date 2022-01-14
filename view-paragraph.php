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

            <?php 
            $description = explode(" ",$passage[0]['description']); 
            $count = 0;
            $string = "";
            foreach ($description as $key => $value) {
                $mvalue = str_replace(array('\'', '"'), '', $value); 
                $words = $obj->fetch("words", array(), array("word"=>$mvalue));
                //echo $value."|".(!empty($words))."<br>";

                if(!empty($words)){
                    //echo $words[0]['id']; die;
                    $string .= "<a href='save-word.php?action=view&id=".$words[0]['id']."' class='word-class' target='_blank'>".$value."</a> ";
                    $count++;
                }else{
                    $string .= $value." ";
                }
            }
            ?>

            <p><?php echo "<strong>Count: </strong>".$count."<br><hr/>"; ?></p>
            <p class="text-justify"> <?php echo $string; ?> </p>

            <?php
                /*$tag_word_sql = "SELECT words.* FROM words INNER JOIN tag_word ON tag_word.word_id = words.id WHERE tag_word.tag_id=".$_GET['id'];
                $tag_word_count_sql = "SELECT COUNT(*) FROM words INNER JOIN tag_word ON tag_word.word_id = words.id WHERE tag_word.tag_id=".$_GET['id'];
                $tag_word_complete_count_sql = "SELECT COUNT(*) FROM words INNER JOIN tag_word ON tag_word.word_id = words.id WHERE tag_word.tag_id=".$_GET['id']." AND words.complete=1";

                $tag_word = $obj->execution($tag_word_sql);
                $tag_word_count = $obj->execution($tag_word_count_sql);
                $tag_word_complete_count = $obj->execution($tag_word_complete_count_sql);
                $all = $tag_word_count[0]['COUNT(*)'];
                $complete = $tag_word_complete_count[0]['COUNT(*)'];
                $precentage = ($all != 0) ? ($complete*100)/($all) : 0;*/
            ?>

        <?php }else{ ?>
            <h2 class="text-center">Invalid Passage Viwe page</h2>
        <?php } ?>
    </div>
  </div>
</div>

<?php require "footer.php"; ?>