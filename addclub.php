<!DOCTYPE html>
<html lang="en">

<head>
	<?php include "php/head.php"; ?>
	<?php
	// submit new club prepared statement
	$addclub = $conn->prepare("INSERT INTO clubs (title, main_para1, image1, para1, owner) VALUES (?, ?, ?, ?, ?)");
	$addclub->bind_param("ssisi", $title, $main_para1, $image1, $para1, $owner);
	// update club prepared statement
	$updateclub = $conn->prepare("UPDATE clubs SET title=?, main_para1=?, image1=?, para1=?, owner=? WHERE title=?");
	$updateclub->bind_param("ssisis", $newtitle, $dmain_para1, $image1, $dpara1, $owner, $target );
			

	if (isset($_POST["title"]) && !isset($_GET["title"])) {
		//	submitting a new club
		$title = $conn->real_escape_string($_POST["title"]);
		$main_para1 = $conn->real_escape_string($_POST["main_para1"]);
		$image1 = $_POST["image1"];
		$para1 = $conn->real_escape_string($_POST["para1"]);
		$owner = $_POST['owner'];
		$intent = '';

		if ($addclub->execute()) {
			echo 	"<script>",
				"setTimeout(function () { createUIPrompt('Club created');}, 50);",
				"</script>";
		} else {
			$error = addslashes($conn->error);
			echo 	"<script>",
				"setTimeout(function () { createUIPrompt('Failed to create club: $error');}, 50);",
				"</script>";
		}
		$addclub->close();
	} elseif (isset($_GET["edit"])) {
		// when editing a club
		$dest = $_GET['edit'];
		$intent = '?title=' . $dest . '';

		$sql = "SELECT * FROM clubs WHERE title='$dest'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();

			$title = $row["title"];
			$main_para1 = $row["main_para1"];
			$para1 = $row["para1"];
			$image1 = $row["image1"];
			$owner = $row["owner"];
		}
	} elseif (isset($_GET["title"])) {
		// submitting an edited club
		$target = $_GET["title"];
		$title = $target;
		$main_para1 = $_POST["main_para1"];
		$image1 = $_POST["image1"];
		$para1 = $_POST["para1"];
		$owner = $_POST['owner'];
		$intent = '?title=' . $target . '';

		$newtitle = $conn->real_escape_string($_POST["title"]);
		$dmain_para1 = $conn->real_escape_string($_POST["main_para1"]);
		$dpara1 = $conn->real_escape_string($_POST["para1"]);

		if ($updateclub->execute()) {
			echo 	"<script>",
				"setTimeout(function () { createUIPrompt('Club updated');}, 50);",
				"</script>";
		} else {
			$error = addslashes($conn->error);
			echo 	"<script>",
				"setTimeout(function () { createUIPrompt('Failed to update club: $error');}, 50);",
				"</script>";
		}
		$updateclub->close();
		$sql = "SELECT * FROM clubs WHERE title='$newtitle'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();

			$title = $row["title"];
			$main_para1 = $row["main_para1"];
			$para1 = $row["para1"];
			$image1 = $row["image1"];
		}
	} else {
		//	when adding a blank club
		$title = "";
		$main_para1 = "";
		$image1 = "";
		$para1 = "";
		$owner = "";
		$intent = "";
	}
	?>
	<script src="https://cdn.tiny.cloud/1/u1vfk8m72ii6gn3b521dfnuyvi517yjvhpc11gijfk2r1m0k/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<script>
		tinymce.init({
			selector: 'textarea'
		});
	</script>
</head>

<body>
	<div id="myNavbar" class="navbar"></div>
	<?php include "php/notif.php"; ?>
	<div class="wrapper">
		<?php
		$head = "Add/edit club";
		include "php/titlerow.php";
		?>
		<div class="bodyContainer">
			<form class="bodyText" action="addclub.php<?php echo $intent; ?>" method="post" autocomplete="off">
				<div class="form__group field">
					<input type="input" class="form__field" placeholder="Title" value="<?php echo $title ?>" name="title" id="title" required />
					<label for="title" class="form__label">Title (max 40)</label>
				</div>
				<div class="form__group field">
					<textarea type="input" placeholder="paragraph 1" name="main_para1" id="mpara1"><?php echo $main_para1 ?></textarea>
				</div>
				<div style="margin-top: 2vh;">
					<label for="image1" style="color: var(--mainText)">Image 1</label>
					<select id="image1" name="image1">
						<?php
						$sql = "SELECT * FROM images";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
								$image = $row["image"];
								$name = $row["name"];
								$id = $row["id"];
						?>
								<option value="<?php echo $id ?>" <?php if ($id == $image1) {
																		$iselected = 1;
																		echo 'selected="selected"';
																	} ?>><?php echo $name ?></option>
						<?php
							}
							if (!isset($iselected)) {
								echo '<option value="" selected disabled hidden>Choose here</option>';
							}
						}
						?>
					</select>
				</div>
				<div class="form__group field">
					<textarea type="input" placeholder="paragraph 2" name="para1" id="para1"><?php echo $para1 ?></textarea>
				</div>
				<div style="margin-top: 2vh;<?php if ($_SESSION["loggedin"] != 1) {
												echo 'display:none';
											} ?>;">
					<label for="owner" style="color: var(--mainText)">Club owner</label>
					<select id="owner" name="owner">
						<?php
						$sql = "SELECT * FROM users";
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
								$email = $row["email"];
								$id = $row["id"];
						?>
								<option value="<?php echo $id ?>" <?php if ($id == $owner) {
																		$aselected = 1;
																		echo 'selected="selected"';
																	}  ?>><?php echo $email ?></option>
						<?php
							}
							if (!isset($aselected)) {
								echo '<option value="" selected disabled hidden>Choose here</option>';
							}
						}
						?>
					</select>
				</div>

				<input type="submit" value="Submit">
				<input type="button" style="margin-top: 0" onclick="window.location.href = 'clubs.php'" value=" Cancel">
			</form>
		</div>
	</div>
	<?php include "php/footer.php" ?>
</body>

</html>