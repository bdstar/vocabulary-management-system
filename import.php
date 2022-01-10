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
    $part_participle = isset($data[2]) ? $data[2] : "";
    $pos = "Verb";

    if(!empty($present)){
        echo $s++." = ".$present." = ".$past." = ".$part_participle."<br>";
    }

    $check = $obj->fetch("words", array("word"), array("word"=>"Good"));
    
    // Condition to check array is not empty
    if(!empty($check)){
        //echo "Given Array is not empty <br>";
    }

    var_dump($check); die;
    /*if($present==$past && $present==$part_participle){
        $same[$s]['present'] = $present;
        $same[$s]['past'] = $past;
        $same[$s]['participle'] = $part_participle;
        $s++;
    }
    //elseif ((substr($past, -2)=='ed')) {
    elseif ((substr($past, -2)=='ed') && (substr($past, 0, -2) == $present) && (substr($part_participle, 0, -2) == $present)) {
        //echo $present." = ".$past." = ".$part_participle."<br>";
    }*/
}

//echo "<pre>"; print_r($same); echo "</pre>";

fclose($file);
?>