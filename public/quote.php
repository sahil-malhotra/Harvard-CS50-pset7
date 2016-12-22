<?php
       
    // configuration
    require("../includes/config.php");
    
    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
       render("symbol_form.php", ["title" => "Get Quote"]);
    }
    
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $stock = lookup($_POST["symbol"]);
        
        if($stock !== false)
        {
            $name = $stock["name"];
            $symbol = $stock["symbol"];
            $price = sprintf("%.2f", $stock["price"]);
            render("price_form.php", ["title" => "Quote", "name" => "$name", "symbol" => "$symbol", "price" => "$price"]);
        }
        else
        {
            apologize("Symbol Not Found.");
        }
    }    
?>    