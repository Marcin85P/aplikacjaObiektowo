<?php

	require_once "question.php";

	unset($_SESSION['choice']);
	
	class Variables {
		private $category_array;
		private $percentage_result;
		private $category_number;
		private $category_occurrence_counter;
		private $array_number;
		private $sum_all_cat;
		
		function __construct() {
			$this->category_array = [];
			$this->percentage_result = [];
			$this->category_number = 0;
			$this->category_occurrence_counter = 0;
			$this->array_number = 0;
		}
		
		function getCategoryArray()  					{return $this->category_array;}
		function getPercentageResult()					{return $this->percentage_result;}
		function getCategoryNumber()					{return $this->category_number;}
		function getCategoryOccurrenceCounter()	{return $this->category_occurrence_counter;}
		function getArrayNumber()						{return $this->array_number;}
	}
	
	class Tabels extends Variables{

		function connect(){
			require "connect.php";
			
			mysqli_report(MYSQLI_REPORT_STRICT);

			$connect = new mysqli($host, $db_user, $db_password, $db_name);
			mysqli_query($connect, "SET CHARSET utf8");
			mysqli_query($connect, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
			
			return $connect;
		}
		
		function sumCategory($connect, $name){
		
			$suma_k = "SELECT SUM(amount) FROM $name 
				WHERE user_id = $_SESSION[id] 
				AND date BETWEEN $_SESSION[first_day] 
				AND $_SESSION[last_date]";
													
			$question = mysqli_query($connect, $suma_k);
			
			while($row = mysqli_fetch_array($question)){
				$sum_all_cat = $row['SUM(amount)'];
			}
			
			return $sum_all_cat;
		}

		function tableView($askAQuestion, $name, $connect){
			$result_incomes = $connect->query($askAQuestion); 
			$how_result = $result_incomes->num_rows;
			
			$_SESSION['suma_k'] = 0;
			$category_occurrence_counter = $this->getCategoryOccurrenceCounter();
			$category_array = $this->getCategoryArray();
			$category_number = $this->getCategoryNumber();
			$percentage_result = $this->getPercentageResult();
			$array_number = $this->getArrayNumber();
			
			$sum_all_cat = $this->sumCategory($connect, $name);
			
			if($name == 'incomes') {
				$questName = 'income_category_assigned_to_user_id';
				$chartTitle = 'PRZYCHODY (%)';
			}
			else {
				$questName = "expense_category_assigned_to_user_id";
				$chartTitle = 'WYDATKI (%)';
			}

			for($i = 0; $i < $how_result; $i++){
				$array_assoc = mysqli_fetch_assoc($result_incomes);
				
				$category_t = $array_assoc['name'];
				$category_t = ucfirst($category_t);		
				$date_t = $array_assoc['date'];
				$comment_t = $array_assoc['comment'];
				$amount_t = $array_assoc['amount'];
				
				$_SESSION['suma_k'] += $amount_t;
			
				echo "<tr id='line'>";
				echo "<td class='position'>$date_t</td>";
				echo "<td class='position'>$category_t</td>";
				echo "<td class='position'>$amount_t</td>";
				echo "<td class='position'>$comment_t</td></tr>";

				for($j=0; $j <= $i; $j++){
					if(in_array($category_t, $category_array))
						$j = $i;
					else{
						$category_array[$array_number] = $category_t;
						
							if($category_number != $array_assoc[$questName]){		
								$category_number = $array_assoc[$questName];
					
								$sumaMY = "SELECT SUM(amount) FROM $name 
									WHERE $questName = $category_number 
									AND user_id = $_SESSION[id] 
									AND date BETWEEN $_SESSION[first_day] 
									AND $_SESSION[last_date]";

								$quest = mysqli_query($connect, $sumaMY);

								while($row = mysqli_fetch_array($quest)){
									$sum_cat = $row['SUM(amount)'];
								}
								if($sum_all_cat <= 0)
									$sum_all_cat = 1;
								
								$percentage_result[$array_number] = round(($sum_cat / $sum_all_cat) * 100, 2);
							}
						$array_number++;
					}
				}
				$array_name[$i] = $category_t;	
			}
?>

			<script type="text/javascript">

				var name_category = <?php echo json_encode($category_array);?>;
				var percentage_result = <?php echo json_encode($percentage_result);?>;
				var title = <?php echo json_encode($chartTitle);?>;

			</script>

<?php
		
			$result_incomes->close();
		
		}
	}