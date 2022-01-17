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



<!--
  -`id` int(11) NOT NULL AUTO_INCREMENT,
  -`word` varchar(200) NOT NULL,
  -`pos` enum('Noun','Pronoun','Adjective','Verb','Adverb','Preposition','Conjunction','Interjection') NOT NULL,
  -`spelling` varchar(300) DEFAULT NULL,
  -`utterance` varchar(300) DEFAULT NULL,
  -`mnemonics` varchar(500) DEFAULT NULL,
  -`smeaning` varchar(300) DEFAULT NULL,
  -`lmeaning` varchar(1000) DEFAULT NULL,
  -`sentence` varchar(1000) DEFAULT NULL,
  -`picture` varchar(200) DEFAULT NULL,
  -`meaning_number` int(11) NOT NULL DEFAULT '1',
  -`past` varchar(100) DEFAULT NULL,
  -`participle` varchar(100) DEFAULT NULL,
  -`complete` int(11) NOT NULL DEFAULT '0',
-->



<!-- Modal -->
<div id="wordModal" data-modal="1" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Word</h4>
            </div>
            <div class="modal-body">
                <p><strong>Word</strong>(<i>verb</i>)[<i>spelling/utterance</i>] = smeaning</p>
                <p>lmeaning</p>
                <p>mnemonics</p>
                <p>sentence</p>
                <?php
                    $meaning_number = 1;
                    if($meaning_number>1) echo $meaning_number."<sup>th</sup>"; 
                    if(isset($pos) && $pos=="v"){
                ?>
                <img src="" alt="" srcset="">
                <table>
                    <tr>
                        <th>Present</th>
                        <th>Past</th>
                        <th>Past Participle</th>
                    </tr>
                    <tr>
                        <td>word</td>
                        <td>past</td>
                        <td>participle</td>
                    </tr>
                </table>
                <?php } ?>
                <p>
                    <strong>Momorized</strong>
                    <input type="checkbox" name="" id="">
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">&times; Close</button>
            </div>
        </div>
    </div>
</div>


<?php require "footer.php"; ?>