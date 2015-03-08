<!DOCTYPE html>
<html>
<head>
    <title>Magazine confirmation</title>
    <link rel="stylesheet" type="text/css" href="magazine_style.css">
</head>
<body>

<?php

require("Magazine.class.php");
require("Subscription.class.php");


$months_selected = 0;
if($_POST['duration_select'] == "6 months"){$months_selected = 6;}
if($_POST['duration_select'] == "12 months"){$months_selected = 12;}
if($_POST['duration_select'] == "18 months"){$months_selected = 18;}
if($_POST['duration_select'] == "24 months"){$months_selected = 24;}

?>


<div id="confirmation_box">

	<h1>Subscription Confirmation</h1>
	<table style="margin-bottom: 80px; padding-bottom: 30px"><td>

    <h2>Personal Information</h2>

    <p>First name: <?php echo $_POST['navn']?> </p>
    <p>Last name: <?php  echo $_POST['lastname']?></p>
    <p>Email: <?php echo $_POST['email']?> </p>
    <p>Gender: <?php echo $_POST['sex']?> </p>

    <h2>Subscribed Magazines</h2>



    <?php  
        $discount = 0;
    	$total_sum = 0;
    	foreach($magazines_array as $value){
    		if(isset($_POST[$value->id]) == true){
                Subscription::subscribe($value->id,$_POST['email']);
    			$total_sum += $value->price;
    			echo $value->name . $value->checked . " " . $value->price . " NOK/YEAR<br>";
                $discount++;
    		}
    	}
        $discount = ($discount * 5) - 5;
    	echo "Price each year: " . $total_sum . " NOK<br>";
        echo "Discount: " . $discount . "%<br>";
        $discount = $discount/100;
        if($months_selected == 6){$total_sum = $total_sum / 2;}
        if($months_selected == 18){$total_sum = $total_sum * 1.5;}
        if($months_selected == 24){$total_sum = $total_sum * 2;}
        echo "Total sum: " . $total_sum*(1-$discount) . " NOK for " .
                 $months_selected . " months"; 

    ?>


    <h2>Subscription period</h2>




    <?php 
        
        $date = date("Y-m-d");
        echo "Your subscription will expire: " . $date;
    ?>

    </table>

</div>


</body>
</html>
