<?php
       
    // configuration
    require("../includes/config.php");
    
    $id = $_SESSION["id"];
    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
       render("funds_form.php", ["title" => "Add Funds"]);
    }
    
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if($_POST["funds"] < 0)
        {
            apologize("Enter a valid amount");
        }
        $funds = sprintf("%.2f", $_POST["funds"]);
        CS50::query("UPDATE users SET cash = cash + $funds WHERE id = $id");
        redirect("/");
    }    
?>    