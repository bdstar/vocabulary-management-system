<?php require_once "database.php";

$filename = isset($argv[1]) ? $argv[1] : "data/verbs.csv";
$file = fopen($filename,"r");

$s = 0;
$same = array();

while(! feof($file))
{
    $data = fgetcsv($file);

    $present = isset($data[0]) ? $data[0] : "";
    $past = isset($data[1]) ? $data[1] : "";
    $participle = isset($data[2]) ? $data[2] : "";
    $pos = "Verb";
    $complete = 0;

    if(!empty($present)){
        echo $s++." = ".$present." = ".$past." = ".$participle."<br>";
        
        // fetch($table, array $columns, array $condition)
        $check = $obj->fetch("words", array("word"), array("word"=>$present, "past"=>$past, "participle"=>$participle));
        
        // Condition to check word is exists
        if(!empty($check)){
            echo "<span style='color: red;'>".$present."</span> word found and can't be inserted to <span style='text-decoration: underline'>'words'</span> table <br><br>";
        }else{
            echo "<span style='color: green;'>".$present."</span> word not found and need to inserted <span style='text-decoration: underline'>'words'</span> table <ul>"; 
            $tablename = "words";
            $ColumnVal = array("word"=>$present,"past"=>$past,"participle"=>$participle,"pos"=>$pos,"complete"=>$complete);
            $dbreturn = $obj->insert($tablename, $ColumnVal);
            echo "<li>".$dbreturn['msg']."</li>";

            $tablename = "tag_word";
            $tag_id = 15;
            $ColumnVal = array("tag_id"=>$tag_id,"word_id"=>$dbreturn['insert_id']);
            $dbreturn = $obj->insert($tablename, $ColumnVal);
            echo "<li>".$dbreturn['msg']."</li></ul>";
        }
    }

    /*if($present==$past && $present==$participle){
        $same[$s]['present'] = $present;
        $same[$s]['past'] = $past;
        $same[$s]['participle'] = $participle;
        $s++;
    }
    //elseif ((substr($past, -2)=='ed')) {
    elseif ((substr($past, -2)=='ed') && (substr($past, 0, -2) == $present) && (substr($participle, 0, -2) == $present)) {
        //echo $present." = ".$past." = ".$participle."<br>";
    }*/
}

//echo "<pre>"; print_r($same); echo "</pre>";

fclose($file);
?>