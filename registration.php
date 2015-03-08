<!DOCTYPE html>
<html>
<head>
    <title>Magazine subscription</title>
    <link rel="stylesheet" type="text/css" href="magazine_style.css">
    
</head>
<body>

<?php


require("Magazine.class.php");
require("Subscription.class.php");


$form_firstName = "";
$form_lastName ="";
$form_email = "";


$selected_sex = "";
$male_status = "unchecked";
$female_status = "unchecked";

$duration = "";


$errors = array($firstname_error = false,
                    $lastname_error  = false,
                    $email_empty_error = false,
                    $email_format_error = false,
                    $gender_error = false,
                    $mag_count_error = false);



if (isset($_POST['navn'])){
    $form_firstName = $_POST['navn'];
}

if(isset($_POST['lastname'])){
    $form_lastName = $_POST['lastname'];
}

if(isset($_POST['email'])){
    $form_email = $_POST['email'];
}

if(!empty($_POST['sex'])){
    if(isset($_POST['subscribe'])){
        $selected_sex = $_POST['sex'];
        if($selected_sex == 'male'){
            $male_status = 'checked';
        }
        if($selected_sex == 'female'){
            $female_status = 'checked';
        }
    }
}



$mag_counter = 0;

foreach($magazines_array as $obj){
    $obj->checked = isset($_POST[$obj->id]);
    if($obj->checked == true){
        $mag_counter++;
    }

}

if(!empty($_POST['duration_select'])){
    $duration = $_POST['duration_select'];
}

$completedForm ="";

if(isset($_POST['subscribe'])){
    $completedForm = true;



    if($form_firstName == ""){
        $errors[0] = true;
        $completedForm = false;
    }


    if($form_lastName == ""){
        $errors[1] = true;
        $completedForm = false;
    }

    if($mag_counter == 0){
        $errors[5] = true;
        $completedForm = false;
    }


    if($form_email == ""){
        $errors[2] = true;
        $completedForm = false;
    }else if(!filter_var($form_email, FILTER_VALIDATE_EMAIL)){
        $errors[3] = true;
        $completedForm = false;
    }



    if($selected_sex == ""){
        $errors[4] = true;
        $completedForm = false;
    }



    
    
}

$url = $completedForm ? "confirmation.php": "";

?>


<form method="post" action="<?php echo $url ?>">


    <h1>Magazine Subscription</h1>


    <div id="personal_details">

        <table>


        <tr><td><p <?php if($errors[4]){echo ' class="errora" ';;} ?>>Firstname</p></td><td>
        <input <?php if($errors[0]){echo ' class="error" ';}?>type="text" name="navn" value="<?php echo $form_firstName;?>" /></td><td>
        <?php if($errors[0]){echo '<p class="error">Missing</p>';}?></td></tr>


        <tr><td><p <?php if($errors[4]){echo ' class="errora" ';;} ?>>Lastname</p></td><td>
        <input <?php if($errors[0]){echo ' class="error" ';}?>type="text" name="lastname" value="<?php echo $form_lastName;?>"></td><td>
        <?php if($errors[1]){echo "<p class='error'>Missing</p>";}?></td></tr>

        <tr><td><p <?php if($errors[4]){echo ' class="errora" ';;} ?>>E-Mail</p></td><td>
        <input <?php if($errors[0]){echo ' class="error" ';}?>type="text" name="email" value="<?php echo $form_email;?>"></td><td>
        <?php if($errors[2]){echo '<p class="error">Missing</p>';}?>
        <?php if($errors[3]){echo '<p class="error">Invalid Email format</p>';}?>
            </td></tr>
    </div>


    <div id="radiobuttons">
        <tr><td> <p <?php if($errors[4]){echo ' class="errora" ';;} ?>>Gender</p></td>
       <td> <input type="radio" name="sex" value="male" <?php if(isset($selected_sex)&& $selected_sex == "male") echo "checked"; ?>>Male
        <input type="radio" name="sex" value="female"<?php if(isset($selected_sex)&& $selected_sex == "female") echo "checked"; ?>>Female</td>

       <td> <?php if($errors[4]){echo '<p class="error">Select a gender</p>';}?></td>
        </tr>  </div>


    <div id ="magazine_list">
    <tr><td>
                <?php
        Subscription::listMagazines($magazines_array);
        ?></td><td style="padding-top: 3px" >
            <?php
            Subscription::listPrice($magazines_array);
            ?></td>
      <td style="width: 100px"> <?php if($errors[5]){echo '<p class="error">Please select an article</p>';}?></td></tr>

    </div>
</table>
    <div id="subscription_year" style="display: inline-block; margin-left: 7px">
        Period
        <select name="duration_select">
            <option value="6 months" <?php if(isset($duration)&& $duration == "6 months") echo "selected"; ?>>6 Months</option>
            <option value="12 months"<?php if(isset($duration)&& $duration == "12 months") echo "selected"; ?>>12 Months</option>
            <option value="18 months"<?php if(isset($duration)&& $duration == "18 months") echo "selected"; ?>>18 Months</option>
            <option value="24 months"<?php if(isset($duration)&& $duration == "24 months") echo "selected"; ?>>24 Months</option>
        </select>
    </div>

    <div id="submit_box" style="display: inline-block; float:right; margin-right: 12px">
        <input type="submit" name="subscribe" value="Subscribe">
    </div>




</form>

</body>
</html>
