<?php require "header.php"; ?>


<div class="jumbotron text-center" style="margin-bottom:0">
  <h1> View Tag</h1>
</div>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-12">
        <?php

/*
https://datatables.net/extensions/responsive/examples/display-types/bootstrap4-modal.html

SELECT words.* FROM words INNER JOIN tag_word ON tag_word.word_id = words.id WHERE tag_word.tag_id=15;
SELECT COUNT(*) FROM words INNER JOIN tag_word ON tag_word.word_id = words.id WHERE tag_word.tag_id=15;
SELECT COUNT(*) FROM words INNER JOIN tag_word ON tag_word.word_id = words.id WHERE tag_word.tag_id=15 AND words.complete=1;
*/
        if($_GET['id']){ $tag = $obj->fetch("tag", array(), array("id"=>$_GET['id'])); ?>
            <h2 class="text-center"><?php echo $tag[0]['name']; ?></h2>
            <p><?php echo $tag[0]['description']; ?></p>

            <?php
                $tag_word_sql = "SELECT words.* FROM words INNER JOIN tag_word ON tag_word.word_id = words.id WHERE tag_word.tag_id=".$_GET['id'];
                $tag_word_count_sql = "SELECT COUNT(*) FROM words INNER JOIN tag_word ON tag_word.word_id = words.id WHERE tag_word.tag_id=".$_GET['id'];
                $tag_word_complete_count_sql = "SELECT COUNT(*) FROM words INNER JOIN tag_word ON tag_word.word_id = words.id WHERE tag_word.tag_id=".$_GET['id']." AND words.complete=1";

                $tag_word = $obj->execution($tag_word_sql);
                $tag_word_count = $obj->execution($tag_word_count_sql);
                $tag_word_complete_count = $obj->execution($tag_word_complete_count_sql);
                $all = $tag_word_count[0]['COUNT(*)'];
                $complete = $tag_word_complete_count[0]['COUNT(*)'];
                $precentage = ($all != 0) ? ($complete*100)/($all) : 0;
            ?>

            Memorized: <?php echo $complete."/".$all; ?><br>
            Accuracty: 0% <br>
            
            <div class="progress">
                <div class="progress-bar" style="width:<?php echo $precentage; ?>%"><?php echo $precentage; ?>%</div>
            </div>
            <hr>

            <table id="tag-word" class="table table-striped table-bordered nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>SN.</th>
                        <th>Word</th>
                        <th>Complete</th>
                        <th>POS</th>
                        <th>Past</th>
                        <th>Participle</th>
                        <th>Spelling</th>
                        <th>Utterance</th>
                        <th>Mnemonics</th>
                        <th>Short Meaning</th>
                        <th>Long Meaning</th>
                        <th>Meaning 'th</th>
                        <th>sentence</th>
                        <th>Picture</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $s = 1;
                    foreach ($tag_word as $key => $word) {
                        $id = $word['id'];
                        $checked = ($word['complete']) ? 'checked' : '';
                        echo "
                        <tr>
                            <td>".$s++."</td>
                            <td>".$word['word']."</td>
                            <td>
                                <input type='checkbox' id='is-complete-$id' onclick='completeMemorized($id)' name='iscomplete' $checked>
                            </td>
                            <td>".$word['pos']."</td>
                            <td>".$word['past']."</td>
                            <td>".$word['participle']."</td>
                            <td>".$word['spelling']."</td>
                            <td>".$word['utterance']."</td>
                            <td>".$word['mnemonics']."</td>
                            <td>".$word['smeaning']."</td>
                            <td>".$word['lmeaning']."</td>
                            <td>".$word['meaning_number']."</td>
                            <td>".$word['sentence']."</td>
                            <td>".$word['picture']."</td>
                        </tr>
                        ";
                    }
                    ?>
                </tbody>
            </table>



        <?php }else{ ?>
            <h2 class="text-center">Invalid Tag Viwe page</h2>
        <?php } ?>
    </div>
  </div>
</div>

<?php require "footer.php"; ?>

<script type="text/javascript">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
</script>