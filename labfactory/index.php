<!DOCTYPE html>
<html>
	<head>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
	<title>login</title>
	<style>
	.window_show {
		display: none; 
		z-index: 1000;
		width: 200px; height: auto;
		right: 20px;
		
		
	}
	.green {
		color: #fff;
	}
	 
	.green a {
		color: #fff;
	}
</style>
	<script type="text/javascript">	
	// Плавное всплытие картинки при загрузки
	$(document).ready(function() {
		setTimeout ("$('.window_show').show('drop');", 100);
	});
	
		function funcBefore(){
			$("#information").html("<hr> Ожидайте ответа...");
		}
	
		function funcSuccess (data){
			$("#information").html (data);
		
		}
		
	$(window).keydown(function(e) {
		if (e.which == 13) {
		var login = document.getElementById("login").value;
				var pass = document.getElementById("passik").value;
				$.ajax ({
					url: "server/login.php",
					type: "POST",
					data: ({login: login, pass: pass}),
					dataType: "text",
					beforeSend: funcBefore,
					success: funcSuccess
				});	
		}
	});
	
	
	
			
		/*$(document).ready (function (){
			$("#enter").bind("click", function (){
				var login = document.getElementById("login").value;
				var pass = document.getElementById("passik").value;
				$.ajax ({
					url: "server/login.php",
					type: "POST",
					data: ({login: login, pass: pass}),
					dataType: "text",
					beforeSend: funcBefore,
					success: funcSuccess
				});
			});
		});*/
	</script>
	</head>
	<body bgcolor="#D6DBDB">
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-left">
				<div class='window_show green'>
					<div class="hidden-xs hidden-sm" ><img src="img/1.jpg" height="45"></div>
				</div>
				</ul>
			</div>	
		</div>	
	</nav>
	<!--hidden-md hidden-lg -->
	<div class="container">
		<div class="row">
		<div class="col-sm-4"></br>
		</div>
		<div class="col-sm-4" style="width: 30%; margin-top: 10%;">
		<div class="welcome"><label>Добро пожаловать</label></div>
		<form id="login" action="server/login.php" method="post">
			<div class="input-group">
				<span class="input-group-addon">Логин:</span>
				<input type="text" class="form-control" placeholder="Введите логин" name="login" id="login" />
			</div>	
            <br/>
			<div class="input-group">
				<span class="input-group-addon">Пароль:</span>
				<input id="passik" type="password" class="form-control" placeholder="Введите пароль" name="pass" id="pass" />
			</div>
			<br>
			<button id="enter" class="btn btn-success btn-block" type="submit">Войти</button>
			<button id="enter" type="submit" class="btn btn-default">как гость</button>
			
		</form>
		<div id="information"></div>
		<!--<a href="#" class="thumbnail">
		<img src="img/2.jpg"  alt="ccp tutorial">
		</a>-->
		</div>
		<div class="col-sm-4"></br>
		</div>
		</div>
		
	</div>
	
	</body>
</html>