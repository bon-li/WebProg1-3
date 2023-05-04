<?php
/* 
    Name: Bonita Li
    Student #: 991358694
    Course Code: SYST10199 
    Date: March 22, 2022
*/

define ("KG_POUND", 2.205);
define ("KG_OUNCE", 35.27);

$weightKg = "";
$totalPackets = "";
$error = "";
$convertLabel="";
$totalConvert="";
$type="";
$numb="";
 
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $weightKg=$_POST['total_weightKg'];
    $totalPackets=$_POST['totalNum'];

    if(!isset($weightKg) ||  trim($weightKg) == "") {
        $error.="You must enter the weight of a packet. <br>";
        $weightKg="";

    }elseif (!is_numeric($weightKg)) {
        $error.= "The weight MUST be a number, you entered: $weightKg.<br>";
        $weightKg="";

    }elseif($weightKg<=0) {
        $error.="The weight must be a positive number, you entered: $weightKg.<br>";
        $weightKg="";
    }
    if (!isset($totalPackets) || trim($totalPackets)==""){
        $error.="You must enter a number of packets.<br>";
        $totalPackets="";

    }elseif(!is_numeric($totalPackets)) {
        $error.= "The number of packets MUST be a number, you entered: $totalPackets.<br>";
        $totalPackets="";

    }elseif($totalPackets<=0){
        $error.="The number of Packets MUST be a positive number, you entered: $totalPackets.<br>";
        $totalPackets="";
    }if ($error==""){
        //$convertLabel="Total Converted Value in Pounds is: ";
    }

    if(isset($_POST['conversion_type'])){
        $type=$_POST['conversion_type'];
    }elseif($type ==""){
        $error.="Please select a value for weight.";
    }
    if($type == "to_Pounds" && $error==""){
        $totalConvert = ($totalPackets * $weightKg) * KG_POUND;
        $numb=number_format($totalConvert,2,'.','');
        
        $convertLabel.="Total Converted Value in Pounds is: ";
        $convertLabel.= '<input type="text" name="convert_Value" value="'. $numb .'">';
        
    }elseif($type == "to_Ounce" && $error==""){
        $totalConvert = ($totalPackets * $weightKg) * KG_OUNCE;
        $numb=number_format($totalConvert,2,'.','');

        $convertLabel="Total Converted Value in Oz is: ";
        $convertLabel.= '<input type="text" name="convert_Value" value="'. $numb .'">';
        
    }elseif($type == "to_Kilograms" && $error==""){
        $totalConvert = $totalPackets * $weightKg;
        $numb=number_format($totalConvert,2,'.','');

        $convertLabel="Total Converted Value in Kilograms is: ";
        $convertLabel.= '<input type="text" name="convert_Value" value="'. $numb .'">';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--
        Name: Bonita Li
        Student #: 991358694
        Course Code: SYST10199
        Date: March 22, 2022
    -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 3</title>
    <link rel="stylesheet" href="./css/stylesheet.css">
</head>
<body>
    <h3>This page calculates total weight of packets, given weight of one packet in kgs and number of packets and print the result in selected unit(Pounds, Ounce, Kilograms) in a new text box</h3>
    <h3><?= $error?></h3>
    <form action="<?=$_SERVER['PHP_SELF'] ?>" method="POST">
        <label id="weightKg_label">Weight of a packet in Kilograms: </label>
        <input type="text" name="total_weightKg" id="weight_kj" value="<?=$weightKg ?>"><br><br>

        <label id="totalNum_label">Total number of packets: </label>
        <input type="text" name="totalNum" id="total_num" value="<?=$totalPackets ?>"><br><br>

        <label id="select_units">Select the unit for total weight (Pounds, Ounce or Kilograms): </label><br><br>
        
        <label id="pounds_label">Pounds</label> 
        <input type="radio" name="conversion_type" value="to_Pounds" checked>
        <label id="ounce_label"> &emsp; Ounce</label> 
        <input type="radio" name="conversion_type" value="to_Ounce">
        <label id="kilograms_label"> &emsp; Kilograms</label> 
        <input type="radio" name="conversion_type" value="to_Kilograms"><br><br>
        
        <input type="submit" name="calculateValue" id="calculate" value="Calculate and Convert"><br><br>
        
        <label name="convert_label" id="convert_label"><?= $convertLabel?></label>

    </form>
</body>
</html>