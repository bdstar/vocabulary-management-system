<?php require "header.php"; ?>

<div class="jumbotron text-center" style="margin-bottom:0">
  <h1>Vocabulary</h1>
  <p>Show all Vocabulary</p> 
</div>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-12">
        <a href="save-word.php" class="btn btn-info pull-right"><i class="fa fa-plus" aria-hidden="true"></i> Add Word</a>
        <table id="word-list" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Word</th>
                    <th>POS</th>
                    <th>Utterance</th>
                    <th>Meaning</th>
                    <th>'th Meaning</th>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Action</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $th_meaning = array(1=>"First", 2=>"Second", 3=>"Third");
                $words = $obj->fetch("words", array(), array());
                foreach($words as $word){
                    echo '
                        <tr>
                            <td>'.$word['word'].'</td>
                            <td>'.$word['pos'].'</td>
                            <td>'.$word['utterance'].'</td>
                            <td>'.$word['smeaning'].'</td>
                            <td>'.$th_meaning[$word['meaning_number']].'</td>
                            <td>'.$word['id'].'</td>
                            <td>'.$word['updated_at'].'</td>
                            <td class="pull-right">
                                <a href="save-word.php?action=update&id='.$word['id'].'" class="btn btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                <a href="save-word.php?action=view&id='.$word['id'].'" class="btn btn-warning"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                <a id="delete-word" data-id="'.$word['id'].'" onclick="deleteData('.$word['id'].')" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a>
                            </td>
                            <td>'.$word['pos'].'</td>
                        </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

  </div>
</div>

<?php require "footer.php"; ?>


<!--
https://mnemonicdictionary.com/?word=good
https://www.vocabulary.com/dictionary/good
https://translate.google.com/?sl=en&tl=bn&text=good%0A&op=translate
https://www.dictionary.com/browse/good
https://www.merriam-webster.com/dictionary/good
https://dictionary.cambridge.org/dictionary/english/good
-->


