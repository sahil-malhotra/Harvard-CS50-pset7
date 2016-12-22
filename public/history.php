<?php

    // configuration
    require("../includes/config.php"); 

    $id = $_SESSION["id"];
    
    // Retrieve all the shares this users owns
	$rows = CS50::query("SELECT * FROM history WHERE user_id = $id");
	
    $positions = [];
    foreach ($rows as $row)
    {
            $positions[] = [
                "transaction" => $row["transaction"],
                "symbol" => $row["symbol"],
                "shares" => $row["shares"],
                "price" => sprintf("%.2f", $row["price"]),
                "timestamp" => $row["timestamp"]
            ];
    }
    
    // render portfolio
    render("history_table.php", ["positions" => $positions, "title" => "History"]);

?>
