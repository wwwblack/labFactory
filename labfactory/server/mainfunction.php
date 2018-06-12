<?php
session_start();
include("mysql.php");
mysql_query("SET NAMES 'utf8';");
//функция отвечающая за вывод списка оборудования на страницу main.php  выволняется кнопкой номер 1.
function funcionViewContentOnMainPage() {
	
	/*$htmlSelectOfType_item = $_POST['htmlSelectOfObject'];
	$htmlSelectOfBrend = $_POST['htmlSelectOfCharacteristic'];
	$htmlSelectOfRoom = $_POST['htmlSelectOfUser'];
	$htmlButtonValue= $_POST['htmlButtonValue'];
	$textSearch = $_POST['textSearch'];
	item.id, item.id_type_item, item.id_brend, item.id_position, item.Containerboard_number  ,item.description_item, item.img_item, item.given,
									   brend.title as titleOfBrend, room.position_name as nameOfPosition,
									   type_item.name_type_item as itemTypeName */
	/*SELECT * FROM `object`
left OUTER JOIN value ON (object.id=value.id_object)
left OUTER JOIN sub_characteristic ON (sub_characteristic.id=value.id_sub_characteristic)
left OUTER JOIN characteristic ON (sub_characteristic.id=value.id_sub_characteristic)*/
	/*$sqlZaprosForViewContent = "SELECT * FROM `object`
								LEFT JOIN `object_characteristic` ON object.id = object_characteristic.id_object
								LEFT JOIN `characteristic` ON object_characteristic.id_characteristic = characteristic.id 
								LEFT JOIN `sub_characteristic` ON characteristic.id = sub_characteristic.id_characteristic
								LEFT JOIN `value` ON sub_characteristic.id = value.id_sub_characteristic_for_value
								LEFT JOIN `device` ON object.id_device = device.id
								LEFT JOIN `users` ON object.id_user = users.id
								";*/
								
										/*//if ($htmlSelectOfObject){
										//$sqlZaprosForViewContent .= " AND `object`.`id` = $htmlSelectOfObject";
										//echo mysql_error();	
										//}
										//if ($htmlSelectOfCharacteristic){
											$sqlZaprosForViewContent .= " AND `characteristic`.`id` = $htmlSelectOfCharacteristic";
											echo mysql_error();	
										}
										//if ($htmlSelectOfUser){
											$sqlZaprosForViewContent .= " AND `object`.`id_user` = $htmlSelectOfUser";
											echo mysql_error();	
										}
										
                                                                             /*   if ($textSearch){
											$sqlZaprosForViewContent .= "A LIKE $textSearch";
											echo mysql_error();	
										}*/
	//Подсчёт строк
	//----------------------------------------------------------
	
	//Через group_object находим эталонные объекты дальне работаем с ним и его дочерними объектами
	$sqlZaprosForViewContent = "SELECT * FROM `group_object`";
	$result_set = mysql_query($sqlZaprosForViewContent);
	while ($result1 = mysql_fetch_array($result_set)){
		echo mysql_error();
		
		$result_for_newSQL_zapros = $result1['id_object_for_group_object'];
		$sql_zapros_main_object = mysql_query("SELECT * FROM `object` WHERE id = $result_for_newSQL_zapros OR id_group = $result_for_newSQL_zapros");
		$result_sql_zapros_main_object = mysql_fetch_array($sql_zapros_main_object);
		//Далее будем записывать всё в переменные для эталонного объекта. Что бы его использовать в спойлере как главный.
		$mainObject_id = $result_sql_zapros_main_object['id'];
		$mainObject_name_object = $result_sql_zapros_main_object['name_object'];
		$mainObject_id_device = $result_sql_zapros_main_object['id_device'];
		$mainObject_id_user = $result_sql_zapros_main_object['id_user'];
		$mainObject_time_add_object = $result_sql_zapros_main_object['time_add_object'];
		$mainObject_time_change_object = $result_sql_zapros_main_object['time_change_object'];
		echo "
		
			<div class=\"row\">
				<div class=\"col-sm-12\" style=\"background-color: #BDC2E8; box-shadow: 0 0 5px; border-radius: 20px; border-left: 1px solid black; border-right: 1px solid black;\">
					<!--СПОЙЛЕР ФАЗАФАКА! -->
						<div class=\"panel panel-default\">
							<div class=\"panel-heading\">
							  <h4 class=\"panel-title\">
									  <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseOne\">
									   ".$mainObject_name_object."
									  </a>
									</h4>
							</div>
							<div id=\"collapseOne\" class=\"panel-collapse collapse\">
								<div class=\"panel-body\">
									<div class=\"row\">
										<div class=\"search-table-outter wrapper\">
											<table class=\"search-table inner\">
												<tr>
													<td>
														Обекты		
													</td>
													<td>
														Устройство		
													</td>
													<td>
														ФИО		
													</td>
													<td>
														Свойства		
													</td>
												</tr>	
												<tr>
													<td>
														".$mainObject_name_object."		
													</td>
												
		";
		$sql_zapros_object_characteristic = mysql_query("SELECT id_characteristic FROM `object_characteristic` WHERE id_object = $mainObject_id");
		//В этом цильке осуществляем поиск характеристики и её свойств
		while($result_sql_zapros_object_characteristic = mysql_fetch_array($sql_zapros_object_characteristic)){
			$id_characteristic_for_seach_characteristic = $result_sql_zapros_object_characteristic['id_characteristic'];
			//В этом цикле записываем полученные данные в переменную для дальнейшей расстановки
			
			$sql_zapros_characteristic = mysql_query("SELECT * FROM `characteristic` WHERE id = $id_characteristic_for_seach_characteristic");
			while($result_sql_zapros_characteristic = mysql_fetch_array($sql_zapros_characteristic)){
				$id_of_characteristic = $result_sql_zapros_characteristic['id'];
				$name_of_characteristic = $result_sql_zapros_characteristic['name_of_characteristic'];
				$decription_of_charecteristic = $result_sql_zapros_characteristic['decription_of_charecteristic'];
				$color_of_characteristic = $result_sql_zapros_characteristic['color_of_characteristic'];
				//иииии что ты думал, правильно! Новый цикл. Далее по id свойства находим принадлежащее к ниму подсвойства. ну поехали.
				
				$sql_zapros_sub_characteristic = mysql_query("SELECT * FROM `sub_characteristic` WHERE id_characteristic = $id_of_characteristic");
				while($result_sql_zapros_sub_characteristic = mysql_fetch_array($sql_zapros_sub_characteristic)){
					$id_from_sub_characteristic = $result_sql_zapros_sub_characteristic['id'];
					$id_characteristic_from_sub_characteristic = $result_sql_zapros_sub_characteristic['id_characteristic'];
					$name_of_sub_characteristic_from_sub_characteristic = $result_sql_zapros_sub_characteristic['name_of_sub_characteristic'];
					$description_of_sub_characteristic_from_sub_characteristic = $result_sql_zapros_sub_characteristic['description_of_sub_characteristic'];
					//и кто бы мог подумать, ладно, не буду тянуть. Далее получаем для подхарактеристик наши заветные значения, будь то текст, или файлы.
					
					$sql_zapros_value = mysql_query("SELECT * FROM `value` WHERE id_sub_characteristic_for_value = $id_from_sub_characteristic");
					while($result_sql_zapros_value = mysql_fetch_array($sql_zapros_value)){
						$id_from_value = $result_sql_zapros_value['id'];
						$id_object_for_value_from_value = $result_sql_zapros_value['id_object_for_value'];
						$id_sub_characteristic_for_value_from_value = $result_sql_zapros_value['id_sub_characteristic_for_value'];
						$value_from_value = $result_sql_zapros_value['value'];

					}
				}
			}
		}
		echo "
												</tr>
											</table>
										</div>	
									</div>
								</div>
							</div>
						</div>
					<!--СПОЙЛЕР закончился ФАЗАФАКА! -->
				</div>
			</div>
		";
	}
}	
//Функция отвечающая за вывод информации на страницу ФАКА. 
function functionViewContentOnFAQPage(){
	$i = 20;
		
		$htmlSelectOfBrend = $_POST['htmlSelectOfBrend'];
		$htmlSelectOfExecuted = $_POST['htmlSelectOfExecuted'];
		$sqlzapros1 = "SELECT * FROM f_a_q_question
										WHERE 1 ";
										echo mysql_error();	
										if ($htmlSelectOfBrend){
											$sqlzapros1 .= " AND `id_brend` = $htmlSelectOfBrend";
											echo mysql_error();	
										}
										if ($htmlSelectOfExecuted){
											$sqlzapros1 .= " AND `executed` = $htmlSelectOfExecuted";
											echo mysql_error();	
										}
										
			echo mysql_error();
			$result_set = mysql_query($sqlzapros1);
			while ($resultFAQ = mysql_fetch_array($result_set)){
				
				//данная переменная для вложенного while
				$idVopros = $resultFAQ['id'];
				
				$i++;
				echo "
				<div class =\"".$resultFAQ['id']."\">
					<div class=\"row\" style=\" box-shadow: 0 0 5px;\" >
						<div class=\"row\">
							<div class=\"col-sm-10\" style=\"margin-left: 5px;\">
							<h3>".$resultFAQ['question']."</h3>
							</div>
							
							
							
				";	
					$a = $resultFAQ['id_user'];
						$c = $resultFAQ['executed'];
						$b = $_SESSION['id'];	
					if ($c==1){
							echo"<div class=\"col-sm-1\"></div><div class=\"col-sm-1\"><img src=\"img/sucsses.jpg\" height=\"30\"></div>";
						}
					elseif( $a==$b ){
							echo " <script type=\"text/javascript\">
									//Скрипт для добавления  ответа
									$(\"#questionExecuted".$resultFAQ['id']."\").bind(\"click\", function (){
										var questionExecuted = document.getElementById(\"questionExecuted".$resultFAQ['id']."\").value;
										$.ajax ({
											url: \"server/functionAjax.php\",
											type: \"POST\",
											data: ({questionExecuted: questionExecuted, functionValue: 13}),
											dataType: \"text\",
											beforeSend: funcBefore,
											success: funcSuccess
										});
									});
									</script>
									<div class=\"col-sm-1\">
									<button class=\"btn btn-success btn-sm\"  id=\"questionExecuted".$resultFAQ['id']."\" value=\"".$resultFAQ['id']."\" type=\"submit\">Готово</button>
									</div>
							";
						
					}
			
				echo "				
							
						</div>
								<div class=\"panel panel-default\" >
									<div class=\"panel-heading\">
										<h4 class=\"panel-title\">
											<a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#".$i."\">
												Ответы
											</a>
										</h4>
									</div>
									<div id=\"".$i."\" class=\"panel-collapse collapse\">
										<div class=\"panel-body\">
					";					
										
										$idUser_Array = Array();
										$sql90 = mysql_query("SELECT f_a_q_answer.answer, users.name as nameOfUser
															  FROM f_a_q_answer 
															  JOIN users ON (users.id = f_a_q_answer.id_user) 
															  WHERE id_question = $idVopros");
										while ($result3 = mysql_fetch_array($sql90)) {
											echo "	
											<div class=\"row\">
												<div class=\"col-sm-12\">
													<div>".$result3["answer"]."</div>
													<div>Ответил - <label for=\"recipient-name\" class=\"control-label\">".$result3["nameOfUser"]."</label></div>
												</div>	
											</div>	
											";	
										}
										/*foreach ($idVopros_Array as $vopros_iddd){
											$idUser_Array[] = $result3["id_user"];
										}
											Для того чтобы решить эту проблему, попробуй нажать на кнопку старт. А так же проверь комутацию. куда идёт in и  out. 
											<br>
											<a>Егор</a>
										*/
					echo "				
												<div class=\"row\">
													<script type=\"text/javascript\">
													//Скрипт для добавления  ответа/*
													$(\"#addAnswer".$resultFAQ['id']."\").bind(\"click\", function (){
														var idQuestionForAnswer = document.getElementById(\"addAnswer".$resultFAQ['id']."\").value;
														var textAnswer = document.getElementById(\"Answer".$resultFAQ['id']."\").value;
														$.ajax ({
																url: \"server/functionAjax.php\",
																type: \"POST\",
																data: ({idQuestionForAnswer: idQuestionForAnswer, textAnswer: textAnswer, functionValue: 8}),
																dataType: \"text\",
																beforeSend: funcBefore,
																success: funcSuccess
														});
													});
														
												
												</script>
												<div class=\"col-sm-6\" style=\" border-top: 1px solid black; \">
												Напишите свой вариант решения проблемы
												<textarea id=\"Answer".$resultFAQ['id']."\" name=\"Answer".$resultFAQ['id']."\" style=\"width:100%; background-color:#FDF5E6; margin-bottom:1%;height:50px; margin-left:1%; min-height:10px;resize:none;\"></textarea>
												</div>
												<div class=\"col-sm-6\" style=\" border-top: 1px solid black; \"><br>
													<button class=\"btn btn-primary btn-md\"  id=\"addAnswer".$resultFAQ['id']."\" value=\"".$resultFAQ['id']."\" type=\"submit\">Подтвердить</button>
												</div>
											</div>	
										</div>
									</div>
								</div>
							<div class=\"row\"><div class=\"col-sm-6\"></div></div>	
							<!--  -->
						</div>
					</div>
				</div>
				<hr>
				";
			}
}
//функция отвечающая за добавление новоо вопроса в FAQ
function functionAddNewQuestion(){
		$htmlSelectOfBrendForAddQuestion = $_POST['htmlSelectOfBrendForAddQuestion'];
		$f_a_q_question = $_POST['f_a_q_question'];
		$id_user = $_SESSION['id'];
		$sqlzapros2 = mysql_query("INSERT INTO `f_a_q_question` (`id_brend`, `id_user`, `question`, `executed`) VALUES ('$htmlSelectOfBrendForAddQuestion', '$id_user', '$f_a_q_question', '0')");
		echo mysql_error();
		
}

function functionAddNewAnswerForQuestion(){
	$idQuestionForAnswer = $_POST['idQuestionForAnswer'];
	$textAnswer = $_POST['textAnswer'];
	$id_user = $_SESSION['id'];
	$sqlzapros2 = mysql_query("INSERT INTO `f_a_q_answer` (`id_question`, `id_user`, `answer`) VALUES ('$idQuestionForAnswer', '$id_user', '$textAnswer')");
	echo mysql_error();
}

function functionAddNewUrlManual(){
    $urlManual = $_POST['urlManual'];
    $descriptionManual = $_POST['descriptionManual'];
    $htmlSelectOfBrendForManual = $_POST['htmlSelectOfBrendForAddManual'];
    $idUser = $_SESSION['id'];
    $sqlzapros29 = mysql_query("INSERT INTO `manuals` (`id_brend`, `description`, `url`, `id_user`) VALUES ('$htmlSelectOfBrendForManual', '$descriptionManual', '$urlManual', '$idUser')");
	echo "<script type=\"text/javascript\">
			alert(\"URL для мануала успешно добавлена\");
		  </script>	
	";
    echo mysql_error();
}

function functionFindManual(){
    
    $htmlSelectOfBrendForFindManual = $_POST['htmlSelectOfBrendForFindManual'];
    $sqlzapros09 = "SELECT * FROM manuals";
                                                    if ($htmlSelectOfBrendForFindManual){
                      					$sqlzapros09 .= " WHERE `id_brend` = '$htmlSelectOfBrendForFindManual'";
                                                        echo mysql_error();	
                                                    }
    $result_setsqlzapros09 = mysql_query($sqlzapros09);
    while ($resultFindManuals = mysql_fetch_array($result_setsqlzapros09)){
				echo "
				<hr>
				<div class =\"".$resultFindManuals['id']."\">
					<div class=\"row\" style=\" box-shadow: 0 0 5px; border-left: 1px solid black; border-right: 1px solid black;\" >
                                            <div class=\"col-sm-2\">
                                            </div>
                                            <div class=\"col-sm-6\">
                                            	<label for=\"recipient-name\" class=\"control-label\">Ссылка</label>
						<br>
                                                <a href=\"".$resultFindManuals['url']."\" rel=\"external\">".$resultFindManuals['url']."</a></br>
                                                <label for=\"recipient-name\" class=\"control-label\">Дополнительное описание</label>    
						<p>".$resultFindManuals['description']."</p>														
                                            </div>
                                            <div class=\"col-sm-4\">
                                            </div>
					</div>
				</div>
				<hr>
				";
    }
}

//Обновление 
function functionQuestionExecuted(){
	$questionExecuted = $_POST['questionExecuted'];
	$sqlzapros1 = mysql_query("UPDATE `f_a_q_question` SET  `executed` = 1 WHERE `id` = '$questionExecuted'");
	echo mysql_error();
}
?>