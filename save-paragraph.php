<?php 
require "header.php"; 

if(!isset($_GET['action'])){$_GET['action']='add';}

if(!strcmp($_GET['action'],'update')){$page_type = "Update";}
elseif(!strcmp($_GET['action'],'view')){$page_type = "View";}
else{$page_type = "Add";}


if(!strcmp($_GET['action'],'update') || !strcmp($_GET['action'],'view')){
  $paragraph = $obj->fetch("paragraph", array(), array("id"=>$_GET['id']));

  $id_value = $paragraph[0]['id'];
  $name_value = $paragraph[0]['name'];
  $description_value = $paragraph[0]['description'];
  $iframe_value = $paragraph[0]['iframe'];
  $count_value = $paragraph[0]['count'];
  $memorize_value = $paragraph[0]['memorize'];
  $accuracy_value = $paragraph[0]['accuracy'];  
}
?>

<div class="jumbotron text-center" style="margin-bottom:0">
  <h1> <?php echo $page_type; ?> Passage</h1>
</div>

<div class="container" style="margin-top:30px">
  <div class="row">
    
    <div class="col-sm-8">
      <div id="operation-result" class="alert">
      </div>
    </div>
<!--
paragraph
  id
  name
  slug
  description
  iframe
  count
  memorize
  accuracy
  updated_at
-->
    <div class="col-sm-8">
      <form id="save-form" data-page="paragraph" data-type="<?php echo $page_type ?>" class="needs-validation" novalidate>

        <?php if($page_type=="Update"){ ?>
          <input type="hidden" id="id" name="id" value="<?php echo isset($id_value) ? $id_value : ""; ?>">
        <?php } ?>

        <div class="form-group row">
          <label for="name" class="col-sm-2 col-form-label">Name: </label>
          <div class="col-sm-10">
            <input type="text" class="form-control input-field" id="name" placeholder="Enter Name" name="name" maxlength="200" value="<?php echo isset($name_value) ? $name_value : ""; ?>" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        </div>

        <div class="form-group row">
          <label for="description" class="col-sm-2 col-form-label">Description: </label>
          <div class="col-sm-10">
            <textarea name="description" id="description" class="form-control input-field" cols="30" rows="10" maxlength="20000" required><?php echo isset($description_value) ? $description_value : ""; ?></textarea>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        </div>

        <div class="form-group row">
          <label for="iframe" class="col-sm-2 col-form-label">URL: </label>
          <div class="col-sm-10">
            <textarea name="iframe" id="iframe" class="form-control input-field" cols="30" rows="5" maxlength="1000" required><?php echo isset($iframe_value) ? $iframe_value : ""; ?></textarea>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        </div>

        <div class="form-group row">
          <label for="count" class="col-sm-2 col-form-label">Word Count: </label>
          <div class="col-sm-10">
            <input type="text" class="form-control input-field" id="count" name="count" maxlength="10" value="<?php echo isset($count_value) ? $count_value : ""; ?>" readonly>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        </div>

        <div class="form-group row">
          <label for="memorize" class="col-sm-2 col-form-label">Memorized: </label>
          <div class="col-sm-10">
            <input type="text" class="form-control input-field" id="memorize" name="memorize" maxlength="10" value="<?php echo isset($memorize_value) ? $memorize_value : ""; ?>" readonly>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        </div>

        <div class="form-group row">
          <label for="accuracy" class="col-sm-2 col-form-label">Accuracy: </label>
          <div class="col-sm-10">
            <input type="text" class="form-control input-field" id="accuracy" name="accuracy" maxlength="10" value="<?php echo isset($accuracy_value) ? $accuracy_value : ""; ?>" readonly>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        </div>

        <?php if(strcmp($_GET['action'],'view')){ ?>
        <div class="form-group row">
          <label for="" class="col-sm-2 col-form-label"> </label>
          <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
        <?php } ?>

    </form>
    </div>
  </div>
</div>

<?php require "footer.php"; ?>