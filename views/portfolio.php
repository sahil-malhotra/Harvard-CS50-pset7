<div>
    <div>
	   	<?php
			print("Hello, ". $cash[0]["username"] .". Your current balance is $" . sprintf("%.2f",$cash[0]["cash"]).".");
		?>
    </div>
    <br>
    <div>
    <table class="table table-striped">
        
			<tr>
				<th>Symbol</th>
				<th>Name</th>
				<th>Shares</th>
				<th>Price</th>
				<th>Total value</th>
			</tr>
			
        <?php foreach ($positions as $position): ?>

            <tr>
                <td><?= $position["symbol"] ?></td>
                <td><?= $position["name"] ?></td>
                <td><?= $position["shares"] ?></td>
                <td><?= $position["price"] ?></td>
                <td><?= $position["total"] ?></td>
            </tr>

        <?php endforeach ?>
        
    </table>
    </div>
</div>


