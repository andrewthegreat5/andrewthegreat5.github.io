<!DOCTYPE html>
<html lang="en">

<head>
	<?php include "php/head.php"; ?>
	<?php
	// add news prepared statement
	$addnews = $conn->prepare("INSERT INTO news (content) VALUES (?)");
	$addnews->bind_param("s", $content);

	if (isset($_POST["content"])) {
		$content = $_POST["content"];

		if ($addnews->execute()) {
			echo 	"<script>",
				"setTimeout(function () {createUIPrompt('News created');}, 50);",
				"</script>";
		} else {
			$error = addslashes($conn->error);
			echo 	"<script>",
				"setTimeout(function () { createUIPrompt('Failed to create news: $error');}, 50);",
				"</script>";
		}
		$addnews->close();
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
		$head = "Create news";
		include "php/titlerow.php";
		?>
		<div class="bodyContainer">
			<form class="bodyText" action="addnews.php" method="post" autocomplete="off">
				<div class="form__group field">
					<textarea type="input" class="form__field" placeholder="some news" name="content" id="content"></textarea>
				</div>
				<input type="submit" value="Submit">
			</form>
		</div>
	</div>
	<?php include "php/footer.php" ?>
</body>

</html>