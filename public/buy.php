<?php

    // configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("buy_form.php", ["title" => "Buy Stock"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["stock"]))
        {
            apologize("Select a stock to buy.");
        }
        else if(empty($_POST["shares"]))
        {
            apologize("Please enter the no. of shares.");
        }
        else if(!preg_match("/^\d+$/", $_POST["shares"]))
        {
            apologize("Enter valid no. of shares.");
        }
        else
        {
		    $id = $_SESSION["id"];
		    $stock = $_POST["stock"];
		    $shares = $_POST["shares"];
        }
        
        $value = lookup("$stock");
        $price = sprintf("%.2f", $value["price"]);
        $symbol = $value["symbol"];
        $worth = sprintf("%.2f", $price*$shares);
        
        // This is the balance of the user
	    $cash = CS50::query("SELECT username, cash FROM users WHERE id = $id");
	    $cash = sprintf("%.2f", $cash[0]["cash"]);
	    
	    if(!$value)
	    {
	        apologize("No such stock exist.");
	    }
        else if($worth < $cash)
        {
            CS50::query("INSERT INTO portfolios (user_id, symbol, shares) 
                    VALUES($id, '$symbol', $shares) 
                    ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)");
            CS50::query("UPDATE users SET cash = cash - $worth WHERE id = $id");  
            
             CS50::query("INSERT INTO history (user_id, transaction, symbol, shares, price) 
                        VALUES($id, 'BUY', '$symbol', $shares, $price)");
                    
            redirect("/");        
        }
        else
        {
            apologize("You do not have enough cash.");
        }
        
    }

?>
