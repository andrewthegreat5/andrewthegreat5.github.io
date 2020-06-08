<!DOCTYPE html>
<html lang="en">

<head>
	<?php include "php/head.php"; ?>
	<?php
	if (isset($_POST["name"])) {
		$name = $_POST["name"];
		$email = $_POST["email"];
		$age = $_POST["age"];
		$club = $_POST["club"];

		$sql = "INSERT INTO sign_ups (full_name, email, age, club)
    		VALUES ('$name', '$email', '$age', '$club')";

		if ($conn->query($sql) === true) {
			echo 	"<script>",
				"setTimeout(function () {createUIPrompt('Record created');}, 50);",
				"</script>";
		} else {
			$error = addslashes($conn->error);
			echo 	"<script>",
				"setTimeout(function () { createUIPrompt('Error creating record: $error');}, 50);",
				"</script>";
		}
	}
	?>

</head>

<body>
	<div id="mySidenav" class="sidenav"></div>
	<div class="wrapper">
		<?php
		$head = "Sign up";
		include "php/titlerow.php";
		?>
		<div class="bodyContainer">
			<form class="bodyText" action="signup.php" method="post" autocomplete="off">
				<div class="form__group field">
					<input type="input" class="form__field" placeholder="Full name" name="name" id="name" required />
					<label for="name" class="form__label">Full name</label>
				</div>
				<div class="form__group field">
					<input type="input" class="form__field" placeholder="last name" name="email" id="email" required />
					<label for="email" class="form__label">Email</label>
				</div>
				<div class="form__group field">
					<input type="input" class="form__field" placeholder="Age" name="age" id="age" required />
					<label for="age" class="form__label">Age</label>
				</div>
				<div style="margin-top: 2vh;">
					<label for="club" style="color: var(--mainText)">Club</label>
					<select id="club" name="club">
						<?php
						$sql = "SELECT * FROM pages";
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
								$title = $row["title"];
						?>
								<option value="<?php echo $title ?>"><?php echo $title ?></option>
						<?php
							}
						}
						?>
					</select>

					<input type="submit" value="Submit">
				</div>
			</form>
		</div>
	</div>
</body>

</html>