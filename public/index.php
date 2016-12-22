<?php

    // configuration
    require("../includes/config.php"); 

    $id = $_SESSION["id"];
    
    // Retrieve all the shares this users owns
	$rows = CS50::query("SELECT id, symbol, shares FROM portfolios WHERE user_id = $id");
	
    $positions = [];
    foreach ($rows as $row)
    {
        $stock = lookup($row["symbol"]);
        if ($stock !== false)
        {
            $positions[] = [
                "name" => $stock["name"],
                "price" => sprintf("%.2f",$stock["price"]),
                "shares" => $row["shares"],
                "symbol" => $row["symbol"],
                "total" => sprintf("%.2f", $row["shares"]*$stock["price"])
            ];
        }
    }
    
    // This is the balance of the user
	$cash = CS50::query("SELECT username, cash FROM users WHERE id = $id");
    
    // render portfolio
    render("portfolio.php", ["positions" => $positions, "title" => "Portfolio", "cash" => $cash]);

?>
