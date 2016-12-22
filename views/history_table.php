<div>
    <table class="table table-striped">
        
			<tr>
				<th>Transaction</th>
				<th>Date/Time</th>
				<th>Symbol</th>
				<th>Shares</th>
				<th>Price</th>
			</tr>
			
        <?php foreach ($positions as $position): ?>

            <tr>
                <td><?= $position["transaction"] ?></td>
                <td><?= $position["timestamp"] ?></td>
                <td><?= $position["symbol"] ?></td>               
                <td><?= $position["shares"] ?></td>
                <td><?= $position["price"] ?></td>

            </tr>

        <?php endforeach ?>
        
    </table>
    </div>