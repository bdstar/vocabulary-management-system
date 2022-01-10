<?php 
require "header.php"; 

if(!isset($_GET['action'])){$_GET['action']='add';}

if(!strcmp($_GET['action'],'update')){$page_type = "Update";}
elseif(!strcmp($_GET['action'],'view')){$page_type = "View";}
else{$page_type = "Add";}

//$page_type = (isset($_GET['action'])=='update')? "Update": ((isset($_GET['action'])=='view')? "View": "Add");
if(!strcmp($_GET['action'],'update') || !strcmp($_GET['action'],'view')){
  $tag = $obj->fetch("words", array(), array("id"=>$_GET['id']));

  $id_value = $tag[0]['id'];
  $word_value = $tag[0]['word'];
  $description_value = $tag[0]['description'];
}
?>

<div class="jumbotron text-center" style="margin-bottom:0">
  <h1> <?php echo $page_type; ?> Tag</h1>
</div>

<div class="container" style="margin-top:30px">
  <div class="row">
    
    <div class="col-sm-8">
      <div id="operation-result" class="alert">
      </div>
    </div>

<!--
- id [id]
- word <input text> [word]
- part-of-speech <dropdown> [pos]
- spelling <input text> [spelling]
- utterance <input text> [utterance]
- mnemonics <input text> [mnemonics]
- short meaning <input text> [smeaning]
- long meaning <textbox> [lmeaning]
- sentence <textbox> [sentence]
- picture <File uploa> [picture]
- meaning_number(default 1)<dropdown> [meaning_number]
tag <searchable multi-select dropdown>
synonyms <searchable multi-select dropdown>
antonyms <searchable multi-select dropdown>

https://stackoverflow.com/questions/50895806/bootstrap-4-multiselect-dropdown
-->

    <div class="col-sm-8">
      <form id="save-word" data-type="<?php echo $page_type ?>" class="needs-validation" novalidate>

        <?php if($page_type=="Update"){ ?>
          <input type="hidden" id="id" name="id" value="<?php echo isset($id_value) ? $id_value : ""; ?>">
        <?php } ?>

        <div class="form-group row">
          <label for="word" class="col-sm-2 col-form-label">Word: </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="word" placeholder="Enter Word" name="word" maxlength="100" value="<?php echo isset($word_value) ? $word_value : ""; ?>" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        </div>

        <div class="form-group row">
          <label for="pos" class="col-sm-2 col-form-label">Parts of Speech: </label>
          <div class="col-sm-10">
            <select class="form-select form-control" id="pos" aria-label="Default select example">
              <option selected>-- Select Parts of Speech --</option>
              <option value="Noun">Noun</option>
              <option value="Pronoun">Pronoun</option>
              <option value="Adjective">Adjective</option>
              <option value="Verb">Verb</option>
              <option value="Adverb">Adverb</option>
              <option value="Preposition">Preposition</option>
              <option value="Conjunction">Conjunction</option>
              <option value="Interjection">Interjection</option>
            </select>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        </div>

        <div class="form-group row">
          <label for="spelling" class="col-sm-2 col-form-label">Spelling: </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="spelling" placeholder="Enter spelling" name="spelling" maxlength="100" value="<?php echo isset($spelling_value) ? $spelling_value : ""; ?>" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        </div>  
        
        <div class="form-group row">
          <label for="utterance" class="col-sm-2 col-form-label">Utterance: </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="utterance" placeholder="Enter utterance" name="utterance" maxlength="100" value="<?php echo isset($utterance_value) ? $utterance_value : ""; ?>" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        </div>

        <div class="form-group row">
          <label for="mnemonics" class="col-sm-2 col-form-label">Mnemonics: </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="mnemonics" placeholder="Enter mnemonics" name="mnemonics" maxlength="100" value="<?php echo isset($mnemonics_value) ? $mnemonics_value : ""; ?>" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        </div>

        <div class="form-group row">
          <label for="smeaning" class="col-sm-2 col-form-label">Short Meaning: </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="smeaning" placeholder="Enter short meaning" name="smeaning" maxlength="100" value="<?php echo isset($smeaning_value) ? $smeaning_value : ""; ?>" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        </div>

        <div class="form-group row">
          <label for="lmeaning" class="col-sm-2 col-form-label">Long Meaning: </label>
          <div class="col-sm-10">
            <textarea name="lmeaning" id="lmeaning" class="form-control" cols="30" rows="10" maxlength="200" required><?php echo isset($lmeaning_value) ? $lmeaning_value : ""; ?></textarea>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        </div>

        <div class="form-group row">
          <label for="sentence" class="col-sm-2 col-form-label">Sentence: </label>
          <div class="col-sm-10">
            <textarea name="sentence" id="sentence" class="form-control" cols="30" rows="10" maxlength="200" required><?php echo isset($sentence_value) ? $sentence_value : ""; ?></textarea>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        </div>

        <div class="form-group row">
          <label for="picture" class="col-sm-2 col-form-label">Picture: </label>
          <div class="col-sm-10 custom-file">
            <input type="file" class="custom-file-input" id="picture" name="picture">
            <label class="custom-file-label" for="picture">Choose file</label>
          </div>
        </div>

        <div class="form-group row">
          <label for="meaning_number" class="col-sm-2 col-form-label">Number'th Meaning: </label>
          <div class="col-sm-10">
            <select class="form-select form-control" id="meaning_number" aria-label="Default select example">
              <option value="1" selected>First Meaning</option>
              <option value="2">Second Meaning</option>
              <option value="3">Third Meaning</option>
              <option value="4">Fourth Meaning</option>
            </select>
          </div>
        </div>


        <div class="form-group row">
          <label for="tag" class="col-sm-2 col-form-label">Tags: </label>
          <div class="col-sm-10">
          <select class="live-selectpicker form-select form-control" id="tag" multiple data-live-search="true">
              <option selected>-- Select Parts of Speech --</option>
              <option value="Noun">Noun</option>
              <option value="Pronoun">Pronoun</option>
              <option value="Adjective">Adjective</option>
              <option value="Verb">Verb</option>
              <option value="Adverb">Adverb</option>
              <option value="Preposition">Preposition</option>
              <option value="Conjunction">Conjunction</option>
              <option value="Interjection">Interjection</option>
            </select>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        </div>

        <!--<select class="live-selectpicker form-select form-control" id="tag" multiple data-live-search="true">
          <option>Mustard</option>
          <option>Ketchup</option>
          <option>Relish</option>
        </select>-->

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