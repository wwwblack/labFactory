<?php
session_start();
include("/server/mysql.php");
include("/server/function.php");
mysql_query("SET NAMES 'utf8';");
?>
<html>
	<head>
	<title>F.A.Q.</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="js/bootstrap.min.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
	<link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/demo.css">
	<link rel="stylesheet" href="css/easydropdown.metro.css" type="text/css"/>
    <!-- Pushy CSS -->
    <link rel="stylesheet" href="../css/pushy.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.easydropdown.js" type="text/javascript"></script>
		<script type="text/javascript">
                function externalLinks() {
                links = document.getElementsByTagName("a");
                for (i=0; i<links.length; i++) {
                  link = links[i];
                  if (link.getAttribute("href") && link.getAttribute("rel") == "external")
                  link.target = "_blank";
                }
               }
               window.onload = externalLinks;
                    
		function funcBefore(){
			$("#content").html("<hr><img src=\"img/download.gif\" alt=\"Пример\" width=\"150\" height=\"150\">");
		}
	
		function funcSuccess (data){
			$("#content").html (data);
		
		}
                
                //Функции не работают пока не загрузим их полностью
		$(document).ready (function (){
                        //функция выполняющая поиск вопросов в FAQ
			$("#find").bind("click", function (){
			var functionValue = document.getElementById("find").value;	
			var htmlSelectOfBrend = document.getElementById("htmlSelectOfBrendforAnswer").value;
			var htmlSelectOfExecuted = document.getElementById("htmlSelectOfExecuted").value;
			$.ajax ({
					url: "server/functionAjax.php",
					type: "POST",
					data: ({functionValue: functionValue, htmlSelectOfBrend: htmlSelectOfBrend, htmlSelectOfExecuted: htmlSelectOfExecuted}),
					dataType: "text",
					beforeSend: funcBefore,
					success: funcSuccess
				});
			});
			//-------------------------------------------------------------
			//Добавление вопроса в FAQ
			$("#enter").bind("click", function (){
				var functionValue = document.getElementById("enter").value;
				var htmlSelectOfBrendForAddQuestion = document.getElementById("htmlSelectOfBrendForAddQuestion").value;
				var f_a_q_question = document.getElementById("question").value;
				$.ajax ({
					url: "server/functionAjax.php",
					type: "POST",
					data: ({functionValue: functionValue, f_a_q_question: f_a_q_question,
                                                    htmlSelectOfBrendForAddQuestion:htmlSelectOfBrendForAddQuestion}),
					dataType: "text",
					beforeSend: funcBefore,
					success: funcSuccess
				});
				document.getElementById('question').value='';
				alert ("Ваш вопрос успешно добавлен");
			});                        
                // функция отвечающая за поиск в разделе мануалы
            $("#findManuals").bind("click", function (){
				var functionValue = document.getElementById("findManuals").value;
                var htmlSelectOfBrendForFindManual = document.getElementById("htmlSelectOfBrendForFindManual").value;
                $.ajax ({
					url: "server/functionAjax.php",
					type: "POST",
					data: ({functionValue: functionValue, htmlSelectOfBrendForFindManual:htmlSelectOfBrendForFindManual}),
					dataType: "text",
					beforeSend: funcBefore,
					success: funcSuccess
				});
			});
			
			 $("#enterUrlManual").bind("click", function (){
				var urlManual = document.getElementById("urlManual").value;
				var functionValue = document.getElementById("enterUrlManual").value;
                var htmlSelectOfBrendForAddManual = document.getElementById("htmlSelectOfBrendForAddManual").value;
				var descriptionManual = document.getElementById("descriptionManual").value;
                $.ajax ({
					url: "server/functionAjax.php",
					type: "POST",
					data: ({functionValue: functionValue, urlManual:urlManual, htmlSelectOfBrendForAddManual:htmlSelectOfBrendForAddManual, descriptionManual:descriptionManual }),
					dataType: "text",
					beforeSend: funcBefore,
					success: funcSuccess
				});
			});
			
		});
	</script>
	<title>login</title>
	</head>
	<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
		
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			
			<ul class="nav navbar-nav navbar-left">
				<div class='window_show green'>
					<div class="hidden-xs hidden-sm" ><img src="img/1.jpg" height="45"><label>Лаборатория микроскопии ДВФУ</label></div>
				</div>
			</ul>	
			
			<div class="navbar-collapse collapse">

				<ul class="nav navbar-nav navbar-right">
				
					<li><a href="main.php">Каталог</a></li>
					<li class="active"><a  href="f_a_q.php">F.A.Q.</a></li>
					<li><a  href="manuals.php">Мануал</a></li>
					<?php 
						if (isset($_SESSION['login'])){
							echo  "<li ><a href=\"..\profile.php\">Профиль</a></li>";
						}
						else
						{
							echo "<li><a href=\"index.php\">Вход</a></li>";
						}
						?>
					<li><a href="feedback.php">Feedback</a></li>
					<li><a href="clear.php">Выход</a></li>
				</ul>
			</div>	
		</div>	
	</nav>
	<div class="container">
	
		<div class="row">
			<div class="col-sm-6" style=\"background-color: #BDC2E8; box-shadow: 0 0 5px; border-radius: 20px; border-left: 1px solid black; border-right: 1px solid black;\">
				<!--СПОЙЛЕР ФАЗАФАКА! -->
					<div class="panel panel-default">
						<div class="panel-heading">
						  <h4 class="panel-title">
								  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
								   Ответы
								  </a>
								</h4>
						</div>
						<div id="collapseOne" class="panel-collapse collapse">
							<div class="panel-body">
							<div class="row">
							<div class="col-sm-4">
								Производитель
								<select style="  width: 100px;"  id="htmlSelectOfBrendforAnswer" name="htmlSelectOfBrend" >
										<option value="" class="label">Все</option>
														<?php
														//Не забуть это переделать в ajax балбес 
														//через селект вытаскиваем тип по айди
															$sqlZaprosBrend = mysql_query("SELECT f_a_q_question.id_brend, brend.title 
																							   FROM f_a_q_question
																							   JOIN brend ON ( brend.id = f_a_q_question.id_brend ) 
																							   GROUP BY  `title` 
																							   ORDER BY  `title` ");
															while ($result_sqlZaprosBrend = mysql_fetch_array($sqlZaprosBrend)) {
																echo "<option select value =".$result_sqlZaprosBrend["id_brend"].">".$result_sqlZaprosBrend['title']."";	
															}
														?>
								</select>
							</div>
							<div class="col-sm-4">
								Выполнено  <br>      
								<select style="  width: 100px;"  id="htmlSelectOfExecuted" name="htmlSelectOfBrend" >
										<option value="" class="label">Все</option>
										<option select value="1" >Ответ найден</option>
										<option select value="0" >Ответ не найден</option>
								</select>
							</div>
							<div class="col-sm-4">	
								<button style="margin-top: 15px;" class="btn btn-primary btn-sm" id="find" value="6" type="submit">Поиск</button>
							</div>
							</div>
							</div>
						</div>
					</div>
				<!--СПОЙЛЕР закончился ФАЗАФАКА! -->
			</div>
	
			<div class="col-sm-6" >
				<!--СПОЙЛЕР ФАЗАФАКА! -->
					<div class="panel panel-default" >
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
									Задать вопрос
								</a>
							</h4>
						</div>
						<div id="collapseTwo" class="panel-collapse collapse">
							<div class="panel-body">
								<select style=" width: 150px;"  id="htmlSelectOfBrendForAddQuestion" name="htmlSelectOfBrendForAddQuestion" >
										<option value="" class="label">Производитель</option>
														<?php
														//Не забуть это переделать в ajax балбес
														//через селект вытаскиваем тип по айди
															$sqlZaprosBrend = mysql_query("SELECT * FROM brend ORDER BY title ");
															while ($result_sqlZaprosBrend = mysql_fetch_array($sqlZaprosBrend)) {
																echo "<option select value =".$result_sqlZaprosBrend ["id"].">".$result_sqlZaprosBrend['title']."";	
															}
														?>
								</select>
								<p>Задать вопрос:</p>
								<textarea id="question" class="form-control" name="question" style="width:90%; background-color:#FDF5E6; height:50px;  min-height:10px;resize:none;"></textarea>
								<br>
								<button id="enter" class="btn btn-primary btn-md"  style="" value="7" type="submit">Потвердить</button>
							</div>
						</div>
					</div>
				<!--СПОЙЛЕР закончился ФАЗАФАКА! -->
			</div>
	
		</div>
	
	<div class="container">	
		<div class="row">
			<div  class="col-sm-12">
				<div id="content">
						
				</div>
			</div>
		</div>
	</div>		
	</div>
	

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>	
	<script src="../js/bootstrap.min.js"></script>
	 <script src="../js/pushy.min.js"></script>
	</body>
</html>