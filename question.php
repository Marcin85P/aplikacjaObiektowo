<?php

	function setActualDate(){
		$_SESSION['last_date'] = date('Ymd');
		$_SESSION['first_day'] = date('Ym01');
		$_SESSION['score'] = '(bieżący miesiąc)';
	}
	
	function askAQuestionIncome(){
		return 
			"SELECT incomes.user_id, incomes.income_category_assigned_to_user_id, incomes.amount, incomes.date, incomes.comment,  incomes_category_assigned_to_users.user_id, incomes_category_assigned_to_users.name
					FROM incomes, incomes_category_assigned_to_users 
						WHERE incomes.income_category_assigned_to_user_id = incomes_category_assigned_to_users.id 
							AND incomes.user_id=$_SESSION[id] 
							AND incomes.date 
								BETWEEN $_SESSION[first_day] 
								AND $_SESSION[last_date]
							AND incomes.date 
								ORDER BY date DESC";
	}
	
	function askAQuestionExpense(){
		return
			"SELECT expenses.user_id, expenses.expense_category_assigned_to_user_id, expenses.amount, expenses.date, expenses.comment,  expenses_category_assigned_to_users.user_id, expenses_category_assigned_to_users.name
					FROM expenses, expenses_category_assigned_to_users 
						WHERE expenses.expense_category_assigned_to_user_id = expenses_category_assigned_to_users.id 
							AND expenses.user_id=$_SESSION[id] 
							AND expenses.date 
								BETWEEN $_SESSION[first_day] 
								AND $_SESSION[last_date]
							AND expenses.date 
								ORDER BY date DESC";
	}
	
	if(!isset($_SESSION['login_user'])){	
		header('Location: index.php');
		exit();
	}
	
	if(!isset($_SESSION['choice'])){
		setActualDate();
	}