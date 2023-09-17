Lucky Spin - Gender
===================

This plugin will display profiles (like lucky spin) based on the gender. It will 
display 3 columns, Females, Males and Couples (Women, Men and Couples).

Installation Notes.
==================

1.	Edit index.php and just before 

		$t->assign('rendered_page', $t->fetch('homepage.tpl') );

	add 
		include('luckySpin_gender.php');


3.	edit homepage.tpl file and where you want the luckySpin Gender to appear, just add

	{$luckySpinGender}
	
	This will display all three columns, based on data availability.
	
	
	
	


