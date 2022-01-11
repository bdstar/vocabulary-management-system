<?php 
require "header.php"; 

if(!isset($_GET['action'])){$_GET['action']='add';}

if(!strcmp($_GET['action'],'update')){$page_type = "Update";}
elseif(!strcmp($_GET['action'],'view')){$page_type = "View";}
else{$page_type = "Add";}

$pos = array(
  "" => "-- Select --",
  "Noun" => "Noun",
  "Pronoun" => "Pronoun",
  "Adjective" => "Adjective",
  "Verb" => "Verb",
  "Adverb" => "Adverb",
  "Preposition" => "Preposition",
  "Conjunction" => "Conjunction",
  "Interjection" => "Interjection"
);

//$page_type = (isset($_GET['action'])=='update')? "Update": ((isset($_GET['action'])=='view')? "View": "Add");
$pos_value = "";
if(!strcmp($_GET['action'],'update') || !strcmp($_GET['action'],'view')){
  $word = $obj->fetch("words", array(), array("id"=>$_GET['id']));
  //echo "<pre>"; print_r($word); echo "</pre>"; die;

  $id_value = $word[0]['id'];
  $word_value = $word[0]['word'];
  $word_past_value = $word[0]['past'];
  $word_participle_value = $word[0]['participle'];
  $pos_value = $word[0]['pos'];
  $spelling_value = $word[0]['spelling'];
  $utterance_value = $word[0]['utterance'];
  $mnemonics_value = $word[0]['mnemonics'];
  $smeaning_value = $word[0]['smeaning'];
  $lmeaning_value = $word[0]['lmeaning'];
  $sentence_value = $word[0]['sentence'];
  $meaning_number = $word[0]['meaning_number'];  
}
?>

<div class="jumbotron text-center" style="margin-bottom:0">
  <h1> <?php echo $page_type; ?> Word</h1>
</div>

<div class="container" style="margin-top:30px">
  <div class="row">
    
    <div class="col-sm-8">
      <div id="operation-result" class="alert">
      </div>
    </div>
<!--
ID                Name                  Table
-----------------------------------------------------
id                id                    id
word              word                  word
word-past         past                  past
word-participle   participle            participle
pos               pos                   pos
spelling          spelling              spelling
utterance         utterance             utterance
mnemonics         mnemonics             mnemonics
smeaning          smeaning              smeaning
lmeaning          lmeaning              lmeaning
sentence          sentence              sentence
meaning-number    meaning_number        meaning_number
complete          complete              complete
                                        picture
-->
    <div class="col-sm-8">
      <form id="save-form" data-page="words" data-type="<?php echo $page_type ?>" class="needs-validation" novalidate>

        <?php if($page_type=="Update"){ ?>
          <input type="hidden" id="id" name="id" value="<?php echo isset($id_value) ? $id_value : ""; ?>">
        <?php } ?>

        <div class="form-group row">
          <label for="word" class="col-sm-3 col-form-label">Word: </label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="word" placeholder="Enter Word" name="word" maxlength="100" value="<?php echo isset($word_value) ? $word_value : ""; ?>" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        </div>

        <div class="form-group row">
          <label for="word" class="col-sm-3 col-form-label">Word(Past Form): </label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="past" placeholder="Enter Past Form" name="past" maxlength="100" value="<?php echo isset($word_past_value) ? $word_past_value : ""; ?>" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        </div>

        <div class="form-group row">
          <label for="word" class="col-sm-3 col-form-label">Word(Past participle Form): </label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="participle" placeholder="Enter past participle Form" name="participle" maxlength="100" value="<?php echo isset($word_participle_value) ? $word_participle_value : ""; ?>" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        </div>

        <div class="form-group row">
          <label for="pos" class="col-sm-3 col-form-label">Parts of Speech: </label>
          <div class="col-sm-9">
            <select class="form-select form-control" id="pos" name="pos" aria-label="Default select example">
              <?php 
              foreach ($pos as $key => $value) {
                if($pos_value == $value)
                echo '<option value="'.$key.'" selected>'.$value.'</option>';
                else
                echo '<option value="'.$key.'">'.$value.'</option>';
              }
              ?>
            </select>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        </div>

        <div class="form-group row">
          <label for="spelling" class="col-sm-3 col-form-label">Spelling: </label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="spelling" placeholder="Enter spelling" name="spelling" maxlength="100" value="<?php echo isset($spelling_value) ? $spelling_value : ""; ?>" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        </div>  
        
        <div class="form-group row">
          <label for="utterance" class="col-sm-3 col-form-label">Utterance: </label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="utterance" placeholder="Enter utterance" name="utterance" maxlength="100" value="<?php echo isset($utterance_value) ? $utterance_value : ""; ?>" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        </div>

        <div class="form-group row">
          <label for="mnemonics" class="col-sm-3 col-form-label">Mnemonics: </label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="mnemonics" placeholder="Enter mnemonics" name="mnemonics" maxlength="100" value="<?php echo isset($mnemonics_value) ? $mnemonics_value : ""; ?>" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        </div>

        <div class="form-group row">
          <label for="smeaning" class="col-sm-3 col-form-label">Short Meaning: </label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="smeaning" placeholder="Enter short meaning" name="smeaning" maxlength="100" value="<?php echo isset($smeaning_value) ? $smeaning_value : ""; ?>" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        </div>

        <div class="form-group row">
          <label for="lmeaning" class="col-sm-3 col-form-label">Long Meaning: </label>
          <div class="col-sm-9">
            <textarea name="lmeaning" id="lmeaning" class="form-control" cols="30" rows="10" maxlength="200" required><?php echo isset($lmeaning_value) ? $lmeaning_value : ""; ?></textarea>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        </div>

        <div class="form-group row">
          <label for="sentence" class="col-sm-3 col-form-label">Sentence: </label>
          <div class="col-sm-9">
            <textarea name="sentence" id="sentence" class="form-control" cols="30" rows="10" maxlength="200" required><?php echo isset($sentence_value) ? $sentence_value : ""; ?></textarea>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
          </div>
        </div>


        <div class="form-group row">
          <label for="sentence" class="col-sm-3 col-form-label">Is Complete?: </label>
          <div class="col-sm-9">
            <input type="checkbox" class="form-check-input" id="complete" name="complete">
          </div>
        </div>

        <!--<div class="form-group row">
          <label for="picture" class="col-sm-2 col-form-label">Picture: </label>
          <div class="col-sm-10 custom-file">
            <input type="file" class="custom-file-input" id="picture" name="picture">
            <label class="custom-file-label" for="picture">Choose file</label>
          </div>
        </div>-->


        <div class="form-group row">
          <label for="picture" class="col-sm-3 col-form-label">Picture: </label>
          <div class="col-sm-9">
            <div class="form-group">
              <div class="input-group">
                  <span class="input-group-btn">
                      <span class="btn btn-default btn-file">
                          Browse… <input type="file" id="imgInp">
                      </span>
                  </span>
                  <input type="text" name="picture" class="form-control input-file-name" readonly>
              </div>
              <img class="img-thumbnail" id='img-upload'/>
            </div>
          </div>
        </div>        

        <div class="form-group row">
          <label for="meaning_number" class="col-sm-3 col-form-label">Number'th Meaning: </label>
          <div class="col-sm-9">
            <select class="form-select form-control" id="meaning-number" name="meaning_number" aria-label="Default select example">
              <?php 
              for ($i=1; $i<5  ; $i++) { 
                if ($i==$meaning_number)
                  echo '<option value="'.$i.'" selected>'.$i.'</option>';
                else
                  echo '<option value="'.$i.'">'.$i.'</option>';
              }
              ?>
            </select>
          </div>
        </div>


        <div class="form-group row">
          <label for="tag" class="col-sm-3 col-form-label">Tags: </label>
          <div class="col-sm-9">
          <select class="live-selectpicker form-select form-control" name="tags" id="tag" multiple data-live-search="true">
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
          <label for="synonyms" class="col-sm-3 col-form-label">Synonyms: </label>
          <div class="col-sm-9">
          <select class="live-selectpicker form-select form-control" name="synonyms" id="synonyms" multiple data-live-search="true">
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
          <label for="antonyms" class="col-sm-3 col-form-label">Antonyms: </label>
          <div class="col-sm-9">
          <select class="live-selectpicker form-select form-control" name="antonyms" id="antonyms" multiple data-live-search="true">
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

        <?php if(strcmp($_GET['action'],'view')){ ?>
        <div class="form-group row">
          <label for="" class="col-sm-3 col-form-label"> </label>
          <div class="col-sm-9">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
        <?php } ?>

    </form>
    </div>
  </div>
</div>

<?php require "footer.php"; ?>