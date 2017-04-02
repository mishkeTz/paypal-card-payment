<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Pay for something</title>

		<link rel="stylesheet" href="css/app.css">
	</head>
	<body>
		<div class="payment-container">
			<h2 class="header">Pay for something</h2>
			<form action="checkout.php" method="post">
				<label for="item">
					Product
					<input type="text" name="product">
				</label>
				<label for="amount">
					Price
					<input type="text" name="price">
				</label>

				<h3>Card details</h3>

				<label for="card_type">
					Card type
					<select name="card_type" id="card_type">
						<option value="visa">Visa</option>
					</select>
				</label>

				<label for="card_number">
					Card number
					<input type="text" name="card_number">
				</label>

				<label for="card_exp_month">
					Expiry
					<div class="split cf">
						<input type="text" name="card_exp_month">
						<input type="text" name="card_exp_year">
					</div>
				</label>

				<label for="card_cvv">
					CVV
					<input type="text" name="card_cvv">
				</label>

				<label for="card_first_name">
					First name
					<input type="text" name="card_first_name">
				</label>

				<label for="card_last_name">
					Last name
					<input type="text" name="card_last_name">
				</label>

				<input type="submit" value="Pay">
			</form>
		</div>
	</body>
</html>
