/*	PASSWORD STRENGTH METER
		Vijay Nair
		
		This is a result of various scripts taken from various places in the web. 
		
	Password Strength Algorithm:
	
	Password Length:
		4 Points: Less than 4 characters
		8 Points: 5 to 7 characters
		9 - 15 Points: 1 point for each characters above 8 - max 15 points
		
	Letters:
		0 Points: No letters
		7 Points - Lower characters 
		15 - Points upper characters
		25 Points: A mix of Upper case letters and Lower case letters
		-10 points : For all characters are letters only in single case

	Numbers:
		0 Points: No numbers
		10 Points: 1 number
		15 points: 2 numbers
		20 Points: 3 or more numbers
	-5 pOINTS: For all characters are numbers only		

	Characters:
		0 Points: No special characters
		10 Points: 1 special character
		25 Points: More than 1 special character

	Bonus:
		5 Points: Letters and numbers
		10 Points: Letters, numbers, and characters
		15 Points: Mixed case letters, numbers, and characters
		
	Password Text Range:
	
		>= 90: Very Secure
		>= 80: Secure
		>= 70: Very Strong
		>= 60: Strong
		>= 50: Average
		>= 25: Weak
		>= 0: Very Weak
		
*/


// Settings
// -- Toggle to true or false, if you want to change what is checked in the password
var m_strUpperCase = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
var m_strLowerCase = "abcdefghijklmnopqrstuvwxyz";
var m_strNumber = "0123456789";
var m_strCharacters = "!@#$%^&*?_~"

// Check password
function checkPassword(strPassword)
{

	// Reset combination count
	var nScore = nUpperCount = nLowerCount = 0;
	
	// Password length
	// -- Less than 4 characters
	if (strPassword.length < 5)
	{
		nScore += 4;
	}
	// -- 5 to 7 characters
	else if (strPassword.length > 4 && strPassword.length < 8)
	{
		nScore += 8;
	}
	// -- 8 or more
	else if (strPassword.length > 7)
	{
		nScore += 8 + (strPassword.length - 7);
		if (nScore > 15) nScore=15;
	}

	// Letters
	var nUpperCount = countContain(strPassword, m_strUpperCase);
	var nLowerCount = countContain(strPassword, m_strLowerCase);
	var nLowerUpperCount = nUpperCount + nLowerCount;
	// -- All Letters in either lower case or upper case only, not a mix
	if (nLowerCount > 0 ) 
	{ 
		nScore += 7; 
	} else if (nUpperCount > 0 )
	{
		nScore += 15; 
	}
	// -- Letters are upper case and lower case
	else if (nUpperCount > 0 && nLowerCount > 0) 
	{ 
		nScore += 25; 
	}
	
	if (nLowerCount > 0 && nLowerCount == strPassword.lentgh)
	{
		nScore -= 10; 
	} else if (nUpperCount > 0 && nUpperCount == strPassword.lentgh)
	{
		nScore -= 10; 
	}	
	// Numbers
	var nNumberCount = countContain(strPassword, m_strNumber);
	// -- 1 number
	if (nNumberCount > 0 && strPassword.length == nNumberCount) 
	{
		nScore -= 5;
	} else if (nNumberCount == 1)
	{
		nScore += 10;
	} else if (nNumberCount == 1)
	{
		nScore += 15;
	} else if (nNumberCount >= 3) 	
	{
	// -- 3 or more numbers
		nScore += 20;
	}
	
	// Characters
	var nCharacterCount = countContain(strPassword, m_strCharacters);
	// -- 1 character
	if (nCharacterCount == 1)
	{
		nScore += 10;
	}	else if (nCharacterCount > 1)
	{
	// -- More than 1 character
		nScore += 25;
	}
	
	// Bonus
	// -- Letters and numbers
	if (nNumberCount > 0 && nUpperCount > 0 && nLowerCount > 0 && nCharacterCount > 0)
	{
		nScore += 15;
	} else if (nNumberCount > 0 && nLowerUpperCount > 0 && nCharacterCount > 0)
	{
		nScore += 10;
	} else if (nNumberCount > 0 && nLowerUpperCount > 0)
	{
		nScore += 5;
	}
		
	return nScore;
}
 
// Runs password through check and then updates GUI 
function runPassword(strPassword, strFieldID) 
{
	// Check password
	var nScore = checkPassword(strPassword);
	
	// Get controls
	var ctlBar = document.getElementById(strFieldID + "_bar"); 
	var ctlText = document.getElementById(strFieldID + "_text");
	if (!ctlBar || !ctlText)
		return;

	// Set new width
	ctlBar.style.width = (nScore*2)+'px';

 	// Color and text
	// -- Very Secure
 	if (nScore >= 90)
 	{
 		var strText = "Very Secure";
 		var strColor = "#0ca908";
 	}
 	// -- Secure
 	else if (nScore >= 80)
 	{
 		var strText = "Secure";
 		var strColor = "#7ff27c";
	}
	// -- Very Strong
 	else if (nScore >= 70)
 	{
 		var strText = "Very Strong";
 		var strColor = "#1740ef";
	}
	// -- Strong
 	else if (nScore >= 60)
 	{
 		var strText = "Strong";
 		var strColor = "#5a74e3";
	}
	// -- Average
 	else if (nScore >= 50)
 	{
 		var strText = "Average";
 		var strColor = "#e3cb00";
	}
	// -- Weak
 	else if (nScore >= 25)
 	{
 		var strText = "Weak";
 		var strColor = "#e7d61a";
	}
	// -- Very Weak
 	else
 	{
 		var strText = "Very Weak";
 		var strColor = "#e71a1a";
	}
	ctlBar.style.backgroundColor = strColor;
	ctlText.innerHTML = "<span style='color: " + strColor + ";'>" + strText +  "</span>";
}
 
// Checks a string for a list of characters
function countContain(strPassword, strCheck)
{ 
	// Declare variables
	var nCount = 0;
	
	for (i = 0; i < strPassword.length; i++) 
	{
		if (strCheck.indexOf(strPassword.charAt(i)) > -1) 
		{ 
	        	nCount++;
		} 
	} 
 
	return nCount; 
} 
 
 
 
 
 


