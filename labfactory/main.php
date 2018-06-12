<?php
session_start();
include("/server/mysql.php");
mysql_query("SET NAMES 'utf8';");
include("/server/function.php");
?>
<html>
	<head>
	<title>Главная</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="../js/bootstrap.min.js"></script>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/custom.css" rel="stylesheet">
	<link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/demo.css">
	<link rel="stylesheet" href="../css/easydropdown.metro.css" type="text/css"/>
    <!-- Pushy CSS -->
    <link rel="stylesheet" href="../css/pushy.css">
	<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.easydropdown.js" ></script>
	<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
		<script>
		//код для скролла по горизонтали 
		$(function() {
			$('#w-scroll .scroll').css({width: $('.search-table').outerWidth()});
		  $('#w-scroll').scroll(function() {
			$('.search-table-outter').scrollLeft($(this).scrollLeft());
			$(this).css({left: $(this).scrollLeft()});
		  });
		  $(window).scroll(function() {
			if($('.search-table').offset().top + $('.search-table').outerHeight() > $(window).height() + $(window).scrollTop()){
				$('#w-scroll').css({top: $(window).height() + $(window).scrollTop() - 20, bottom: 'auto'});
			}else{
			  $('#w-scroll').css({top: 'auto', bottom: 0});
			};
		  });
		  $('#w-scroll').each(function() {
			if($('.search-table').offset().top + $('.search-table').outerHeight() > $(window).height() + $(window).scrollTop()){
				$(this).css({top: $(window).height() + $(window).scrollTop() - 20, bottom: 'auto'});
			}else{
			  $(this).css({top: 'auto', bottom: 0});
			};
		  });
		});
		// конец скрола по горизонтали
		
		
		
		// AJAX Функции --------------------------------------------------------------------------------------------------------------------------------	
		function funcBefore(){
			$("#content").html("<hr><img align=\"middle\" src=\"img/download.gif\" alt=\"Пример\" width=\"150\" height=\"150\">");
		}
	
		function funcSuccess (data){
			$("#content").html (data);
			
		}
		
		$(document).ready (function (){
			$("#enter").bind("click", function (){
				var functionValue = document.getElementById("enter").value; 
				var htmlSelectOfObject = document.getElementById("htmlSelectOfObject").value;
				var htmlSelectOfCharacteristic = document.getElementById("htmlSelectOfCharacteristic").value;
				var htmlSelectOfUser = document.getElementById("htmlSelectOfUser").value;
                var textSearch = document.getElementById("textSearch").value;
				$.ajax ({
					url: "server/functionAjax.php",
					type: "POST",
					data: ({functionValue: functionValue, htmlSelectOfObject: htmlSelectOfObject, htmlSelectOfCharacteristic: htmlSelectOfCharacteristic, htmlSelectOfUser: htmlSelectOfUser }),
					dataType: "text",
					beforeSend: funcBefore,
					success: funcSuccess
				});
			});
		
			if (document.getElementById('checkBox').checked)
				document.getElementById('chbxStatus').style.backgroundColor = 'green';
			else
				document.getElementById('chbxStatus').style.backgroundColor = 'red';
		
		
		function addUserItem(formId) {
			alert (formId);
			
		}
		});
		// Конец AJAX Функции --------------------------------------------------------------------------------------------------------------------------------	
		
		//Функции для динамических селектов
		//--------------------------------------------------
		/*function dinamicSelectHtmlSelectOfType_item(){
			var htmlSelectOfType_item = document.getElementById("htmlSelectOfType_item").value;
			alert (htmlSelectOfType_item);
		}
		//--------------------------------------------------
		function del(id){
			var sel = window.document.getElementById(id);
			var opts = sel.options;
			while(opts.length > 0){
				opts[opts.length-1] = null;
			}
		}
*/
		
		//Плавное всплытие изображений-----------------------------------------------------------------------------------------------------------------------
		
	/*	$("#addItem").bind("click", function (){
				var htmlSelectOfType_item = document.getElementById("htmlSelectOfType_item").value;
				var htmlSelectOfBrend = document.getElementById("htmlSelectOfBrend").value;
				var htmlSelectOfRoom = document.getElementById("htmlSelectOfRoom").value;
				$.ajax ({
					url: "server/addItem.php",
					type: "POST",
					data: ({htmlSelectOfType_item: htmlSelectOfType_item, htmlSelectOfBrend: htmlSelectOfBrend, htmlSelectOfRoom:htmlSelectOfRoom}),
					dataType: "text",
					beforeSend: funcBefore,
					success: funcSuccess
				});
			});
			*/
	/*	$(document).ready(function(){
			 $("#tag").autocomplete("server/autocomplete.php", {
					selectFirst: true
				});
		});
			*/
	</script>
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
				
					<li class="active" style="background: blue;"><a href="#">Каталог</a></li>
					<li><a href="f_a_q.php">FAQ</a></li>
					<li><a  href="manuals.php">Методички</a></li>
					<?php 
						if (isset($_SESSION['login'])){
							echo  "	
							<li ><a href=\"profile.php\">Профиль</a></li>";
						}
						else
						{
							echo "<li><a href=\"..\index.php\">Вход</a></li>";
						}
						?>
					<li><a href="FeedBack.php">FeedBack</a></li>
					<li><a href="clear.php">Выход</a></li>
				</ul>
			</div>	
		</div>	
	</nav>

	<div class="container">
	<!-- Строка фильтров -->
		<div class="row">
			<div  class="col-sm-2">
					<label>Объект</label>
                    <select style="width: 150px;" id="htmlSelectOfObject" onchange="dinamicSelectHtmlSelectOfType_item();" name="htmlSelectOfObject">
						<option value="" class="label">Все</option>

										<?php
										//Не забуть это переделать в ajax
										//через селект вытаскиваем тип по айди
											$sqlZaprosobject = mysql_query("SELECT object.id, object.name_object FROM object");
											while ($result_sqlZaprosobject = mysql_fetch_array($sqlZaprosobject)) {
												echo "<option select value =".$result_sqlZaprosobject["id"].">".$result_sqlZaprosobject['name_object']."</option>";
											}
										?>
					</select>
				</div>	
				<div  class="col-sm-2" >	
					<label>Характеристика</label>
					<select style="  width: 150px;" id="htmlSelectOfCharacteristic" name="htmlSelectOfCharacteristic" >
						<option value="" class="label">Все</option>
										<?php
										//Не забуть это переделать в ajax
										//через селект вытаскиваем тип по айди SELECT * FROM `user` GROUP BY `index` // $arr = explode(":", $valueItem);
											$sqlZaprosobject_characteristic = mysql_query("SELECT DISTINCT object_characteristic.id_characteristic, characteristic.name_of_characteristic as namesBLAY FROM object_characteristic 
																		   JOIN characteristic ON ( characteristic.id = object_characteristic.id_characteristic ) 
																		   " );
											while ($result_sqlZaprosBrend = mysql_fetch_array($sqlZaprosobject_characteristic)) {
												echo "<option select value =".$result_sqlZaprosBrend ["id_characteristic"].">".$result_sqlZaprosBrend['namesBLAY']."</option>";	
											}
										?>
					</select>
				</div>	
				<div  class="col-sm-2" >	
					<label>Пользователь</label>
					<select style="  width: 150px;" id="htmlSelectOfUser" name="htmlSelectOfUser">
						<option value=""  class="label">Все</option>
											<?php
											//Не забуть это переделать в ajax
											//через селект вытаскиваем тип по айди
												$sqlZaprosUser = mysql_query("SELECT object.id_user, users.first_name as i, users.last_name as f, users.patronymic as o
																		   FROM object
																		   JOIN users ON ( object.id_user=users.id ) 
																		   ");
												while ($result_sqlZaprosUser = mysql_fetch_array($sqlZaprosUser)) {
													echo "<option select value =".$result_sqlZaprosUser["id_user"].">".$result_sqlZaprosUser['f']." ".$result_sqlZaprosUser['i']." ".$result_sqlZaprosUser['o']."</option>";	
												}
											?>
					</select>
				</div>	
				<div  class="col-sm-2" style=" margin-bottom: 3px;">
					<label>Поиск</label>
					<input name="textSearch" type="text" id="textSearch" placeholder="Введите название" size="20"/>
				</div>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Добавить</button>
                                                               <!-- Блок высплывающего сообщения для добавления ссылки на манул и описание к нему  -->
                                                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                                                  <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                      <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        <h4 class="modal-title" id="exampleModalLabel">Добавить новый экземпляр</h4>
                                                                      </div>
                                                                      <div class="modal-body">
                                                                        <form>
                                                                          <div class="form-group">
                                                                            <label for="recipient-name" class="control-label">Введите название</label>
                                                                            <input  type="text" class="form-control" id="urlManual">
                                                                          </div>
									<div class="form-group">  
                                                                        <label for="sel1">Выберите свойства</label>                                                                       
                                                                        <select class="form-control" style="  width: 150px;"  id="htmlSelectOfBrendForAddManual">
									<option value="" class="label">Свойство</option>
										<?php
										//Не забуть это переделать в ajax
										//через селект вытаскиваем тип по айди SELECT * FROM `user` GROUP BY `index` // $arr = explode(":", $valueItem);
										$sqlZaprosobject_characteristic = mysql_query("SELECT DISTINCT object_characteristic.id_characteristic, characteristic.name_of_characteristic as namesBLAY FROM object_characteristic 
                                                                                                                            JOIN characteristic ON ( characteristic.id = object_characteristic.id_characteristic ) 
														" );
														while ($result_sqlZaprosBrend = mysql_fetch_array($sqlZaprosobject_characteristic)) {
														echo "<option select value =".$result_sqlZaprosBrend ["id_characteristic"].">".$result_sqlZaprosBrend['namesBLAY']."</option>";	
														}
										?>
                                                                        </select>
									</div>
                                                                            <div>
                                                                                <p>Укажите цвет фона: <input type="color" name="bg" value="#ff0000">
                                                                                <input type="submit" value="Выбрать"></p>
                                                                            </div>
                                                                          <div class="form-group">
                                                                            <label for="message-text" class="control-label">Пояснение:</label>
                                                                            <textarea id="descriptionManual" class="form-control"></textarea>
                                                                          </div>
                                                                        </form>
                                                                      </div>
                                                                      <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                                                                        <button id="enterUrlManual" value="11" type="button" class="btn btn-primary" data-dismiss="modal">Добавить</button>
                                                                      </div>
                                                                    </div>
                                                                  </div>
                                                                </div>
						
				<!--СПОЙЛЕР закончился ФАЗАФАКА! -->
			</div>	
						
				<div  class="col-sm-1" style=" margin-top: 10px;" >
					<button value="1" class="btn btn-primary btn-md" id="enter" type="submit">Поиск</button>						
				</div>	
			</div>
                    
                    
	</div>
<hr>
	
	
		<div id="content" >
		
		</div>
	
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>	
	<script src="../js/bootstrap.min.js"></script>
    <script src="../js/pushy.min.js"></script>
	</body>
</html>