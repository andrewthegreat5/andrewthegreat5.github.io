<?php
    if($_SESSION["loggedin"]==1){
        $signin='<p>Signed in as ' . $_SESSION["username"] . '</p>';
    } else {
        $signin='<p>You are not signed in</p>
		<a href="settings.php#login"><p>Sign in</p></a>';
    }

?>

<div class="titleRow">
	<h1 class="title"><?php print $head;?></h1>
	<div class="signin">
		<?php echo $signin ?>
	</div>
</div>