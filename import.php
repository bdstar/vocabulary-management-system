<?php 
require_once "database.php";
require_once "data/excel_reader/excel_reader.php";

/*------------START: Right from of Verb ----------------------*/
/*
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
}
fclose($file);
*/
/*------------END: Right from of Verb ----------------------*/


/*------------ START: Major Test Vocabulary ----------------------*/
// creates an object instance of the class, and read the excel file data
$excel = new PhpExcelReader;
$excel->read('data/majortests.xls');
function sheetData($sheet) {
    //echo "<pre>"; print_r($sheet); echo "</pre>"; die;
    /*$i = 1;
    foreach($sheet['cells'] as $key => $value){
        echo "<br>".$i++."=$value[1]=$value[2]<br><ul>";

        $tablename = "words";
        $ColumnVal = array("word"=>$value[1],"emeaning"=>$value[2]);
        $dbreturn = $obj->insert($tablename, $ColumnVal);
        echo "<li>".$dbreturn['msg']."</li>";

        $tablename = "tag_word";
        $tag_id = 13;
        $ColumnVal = array("tag_id"=>$tag_id,"word_id"=>$dbreturn['insert_id']);
        $dbreturn = $obj->insert($tablename, $ColumnVal);
        echo "<li>".$dbreturn['msg']."</li></ul>";

    }*/
    /*
    Array
    (
        [maxrow] => 0
        [maxcol] => 0
        [numRows] => 101
        [numCols] => 2
        [cells] => Array
            (
                [1] => Array
                    (
                        [1] => Abhor
                        [2] => hate
                    )
    */
  /*$re = '<table>';     // starts html table
  $x = 1;
  while($x <= $sheet['numRows']) {
    $re .= "<tr>\n";
    $y = 1;
    while($y <= $sheet['numCols']) {
      $cell = isset($sheet['cells'][$x][$y]) ? $sheet['cells'][$x][$y] : '';
      $re .= " <td>$cell</td>\n";  
      $y++;
    }  
    $re .= "</tr>\n";
    $x++;
  }
  return $re .'</table>'; */    // ends and returns the html table
}

$nr_sheets = count($excel->sheets);       // gets the number of sheets
$excel_data = '';              // to store the the html tables with data of each sheet

// traverses the number of sheets and sets html table with each sheet data in $excel_data
for($i=0; $i<$nr_sheets; $i++) {
    //$excel_data .= '<h4>Sheet '. ($i + 1) .' (<em>'. $excel->boundsheets[$i]['name'] .'</em>)</h4>'. sheetData($excel->sheets[$i]) .'<br/>';  
    $sheet = $excel->sheets[$i];
    $i = 1;
    foreach($sheet['cells'] as $key => $value){
        echo "<br>".$i++."=$value[1]=$value[2]<br><ul>";
    
        $tablename = "words";
        $ColumnVal = array("word"=>addslashes($value[1]),"emeaning"=>addslashes($value[2]));
        $dbreturn = $obj->insert($tablename, $ColumnVal);
        echo "<li>".$dbreturn['msg']."</li>";
    
        $tablename = "tag_word";
        $tag_id = 13;
        $ColumnVal = array("tag_id"=>$tag_id,"word_id"=>$dbreturn['insert_id']);
        $dbreturn = $obj->insert($tablename, $ColumnVal);
        echo "<li>".$dbreturn['msg']."</li></ul>";
    }
}

//echo $excel_data;
/*------------ END: Major Test Vocabulary ------------------------*/
?>