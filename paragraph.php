<?php require "header.php"; ?>

<div class="jumbotron text-center" style="margin-bottom:0">
  <h1>Passage</h1>
  <p>Show all Passage</p> 
</div>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-12">
        <a href="save-paragraph.php" class="btn btn-info pull-right"><i class="fa fa-plus" aria-hidden="true"></i> Add Passage</a>
        <table id="word-list" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $page = "paragraph";
                $paragraphs = $obj->fetch("paragraph", array(), array());

                $sn = 1;
                foreach($paragraphs as $paragraph){
                    echo '
                        <tr>
                            <td>'.$sn++.'</td>
                            <td>'.$paragraph['name'].'</td>
                            <td>'.$paragraph['updated_at'].'</td>
                            <td class="pull-right">
                                <a href="save-paragraph.php?action=update&id='.$paragraph['id'].'" class="btn btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                <a href="view-paragraph.php?id='.$paragraph['id'].'" class="btn btn-warning"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                <a id="delete-data" data-id="'.$paragraph['id'].'" data-page="paragraph" onclick="deleteData('.$paragraph['id'].')" class="btn btn-danger">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    ';
                }
                ?>
            </tbody>
        </table>
    </div>

  </div>
</div>

<?php require "footer.php"; ?>


<!--<form id="delete-form-'.$tag['id'].'" action="database.php?page=tag&action=delete&id='.$tag['id'].'" method="POST"></form>-->
<!-- https://sweetalert2.github.io/ -->

