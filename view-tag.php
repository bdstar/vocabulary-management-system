<?php require "header.php"; ?>


<div class="jumbotron text-center" style="margin-bottom:0">
  <h1> View Tag</h1>
</div>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-12">
        <?php
/*
SELECT words.* FROM words INNER JOIN tag_word ON tag_word.word_id = words.id WHERE tag_word.tag_id=15;
SELECT COUNT(*) FROM words INNER JOIN tag_word ON tag_word.word_id = words.id WHERE tag_word.tag_id=15;
SELECT COUNT(*) FROM words INNER JOIN tag_word ON tag_word.word_id = words.id WHERE tag_word.tag_id=15 AND words.complete=1;
*/
        if($_GET['id']){ $tag = $obj->fetch("tag", array(), array("id"=>$_GET['id'])); ?>
            <h2 class="text-center"><?php echo $tag[0]['name']; ?></h2>
            <p><?php echo $tag[0]['description']; ?></p>
            <div class="progress">
                <div class="progress-bar" style="width:70%">70%</div>
            </div>


            <table id="word-list" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Tags</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $page = "tag";
                $tags = $obj->fetch("tag", array(), array());

                $sn = 1;
                foreach($tags as $tag){
                    echo '
                        <tr>
                            <td>'.$sn++.'</td>
                            <td>'.$tag['name'].'</td>
                            <td>'.$tag['updated_at'].'</td>
                            <td class="pull-right">
                                <a href="javascript:void(0)" class="btn btn-info"><i class="fa fa-check" aria-hidden="true"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    ';
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