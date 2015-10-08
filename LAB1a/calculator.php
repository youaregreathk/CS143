<hitml>
<head>
  <title>Calculator</title>
</head>
<body>
<h1>Calculator</h1>
<h4> (Created by Guan Zhou & Kwai Shea on 10/5/2015)</h4> 
 Please type an expression in the following box (e.g., 10.5+20*3/25).

<p>
<form method="GET">
<input type="text" name="expr"> <br><br>
<input type="submit" value="Calculate">

</form>
</p>



<?php
    $input_expr = $_GET["expr"];
    //get rid of all the spaces
    $eval_expr = str_replace(' ', '', $input_expr);
    //check if input expression is empty, if it is, then do nothing
    if ($eval_expr == "")
    {
    }
    //if input expression is empty
    else
    {
      //if encounter any --, then replace it with a +
      $eval_expr = str_replace('--', '+', $eval_expr);
      //valid expression can only contain numbers 0-9 and -+*/ operators
      preg_match("/^[-+.*\/, 0-9]+$/",$eval_expr, $parsed_expr); 
  
      echo "<html><h2>Result</h2></html><p>";
      //check if denominator is 0
      if (preg_match("/\/[0]/",$eval_expr))
      {
        if (!preg_match("/\/[0][.]/",$eval_expr))
        {
          echo "Denominator can not be 0!";
          echo "<br/>";
        }
        else
        {
          eval("\$res = $parsed_expr[0];");
        }
      }
        
      //if denominator is not 0, then evaluate the parsed expression
      if (strstr($eval_expr,'/0') == '')
         eval("\$res = $parsed_expr[0];");

      // print out the result if the output is a number
      if (is_numeric($res))
      {
        echo $input_expr." = ".$res;
        echo "<br/>";
      }
      // invalid expression warning if output result is not number
      else
      {
        if (!preg_match("/\/[0]/",$eval_expr))
          echo "Invalid Expression!"."<br/>";
      }
    }
?>
<h3>Important Notice</h3>
<ul>
<li>Only numbers and +,-,* and / operators are allowed in the expression.
<li>The evaluation follows the standard operator precedence.
<li>The calculator does not support parentheses.
<li>The calculator handles invalid input "gracefully". It does not output PHP error messages.
</ul>
<h3>Following are some simple test case</h3>
Here are some(but not limit to) reasonable test cases:
<ol>
  <li> A basic arithmetic operation:  3+4*5=23 </li>
  <li> An expression with floating point or negative sign : -3.2+2*4-1/3 = 4.46666666667, 3*-2.1*2 = -12.6 </li>
  <li> Some typos inside operation (e.g. alphabetic letter): Invalid input expression 2d4+1 </li>
  <li> Demoninator to be 0 : Warning says that denominator can not be 0 (e.g. 2/0) </li>
</ol>
<h3>This calculator passes all the test case provided by the professor</h3>
<ul>
<li>-49 (Ans: -49)
<li>2+3+4 (Ans: 9)
<li>2*3*-4 (Ans: -24)
<li>2*-1*-2*-3 (Ans: -12)
<li>100-100/100 (Ans: 99)
<li>3/2+1/3 (Ans: close or equal to 1.83333333333)
<li>0/0 (NO excpetion shown on the page)
<li>abcd (Invalid Expression)
<li>one/two (Invalid Expression)
</ul>

</body>
</html>


