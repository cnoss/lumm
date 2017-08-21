<div class="get-in-touch">
	<p>
	<?php
		//$site->contact() = str::email($site->email());
		echo str::email($site->email()) . "<br>";
		echo multiline($site->contact());
	?>
	</p>
</div>