<?php

    // configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("sell_form.php", ["title" => "Sell Stock"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["stock"]))
        {
            apologize("Select a stock to sell.");
        }
        else
        {
		    $id = $_SESSION["id"];
		    $stock = $_POST["stock"];
        }
        
        // If the user doesn't own any of the stock, error message is displayed
        
	    $shares = CS50::query("SELECT shares FROM portfolios WHERE user_id = $id AND symbol = '$stock'");
	    if(!$shares)
	    {
		    apologize("You don't own any shares of this stock");
	    }
	    else
	    {
	        $value = lookup("$stock");
	        $symbol = $value["symbol"];
	        $shares = $shares[0]["shares"];
	        $price =  sprintf("%.2f", $value["price"]);
	        $income = sprintf("%.2f", $shares*$price);
	        
	        //Delete the stock from user's portfolio and update the cash balance.
	        CS50::query("DELETE from portfolios WHERE user_id = $id AND symbol = '$stock'");
	        CS50::query("UPDATE users SET cash = cash + $income WHERE id = $id");
	        
	        CS50::query("INSERT INTO history (user_id, transaction, symbol, shares, price) 
                        VALUES($id, 'SELL', '$symbol', $shares, $price)");
	        
	        
	        redirect("/");
	    }
        
    }

?>
