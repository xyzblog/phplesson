   <?php 
// $x = 5;
// global scope
// function myTest(){
    // using x inside this functin will generate an error
    // echo "<p>Variable x inside function is: $x</P>";
// }
// myTest();
// echo "<p>Variable x outside function is: $x</p>";
// $x = 5;
// global scope
// function yourTest(){
    // using x inside this functin will generate an error
    // global $x;
    // echo "<p>Variable x inside function is: $x</P>";
// }
// yourTest();
// echo "<p>Variable x outside function is: $x</p>";
// 
// note the above examples are global variable function while the one below is the local scope

// function myTest(){
    // $x = 5;
    // local  scope where the variable is defined inside the function
    // // echo "<p>variable x inside function is:$x</p>";
// }
// myTest();
// using x outside the function will generate an error
// // echo"<p>Variable x outside function is: $x</P>";
// WRITING HTML CODES ON PHP
// echo"<hr>";
// echo "<p>This is my website</p>";
//  echo "<h1>Welcome to xyzblog.com</h1>";
// VARIABLE:A container for storing data values. A variable name must start with a letter or the underscore character. A varialbel nmae cannot start with a number. A variable name can only contain alpha-numerical characters and underscores(A-Z, a-z, 0-9, and _). Variable names are case-sensitive($age and $AGE are two different variables).
// $text = "Hello world!<br";
// echo"$text";
// echo $x + $y;
// echo"<br>";
// echo $x - $y; 
// echo "<br>";
// $x = 5;
// $y = 4;
// echo $x * $y;
// echo "<br>";
// echo $x / $y;
// echo "<br>";
// echo $x % $y;
// echo "<br>";
// echo $x ** $y;
// echo "<br>";
// echo $x++;
// echo"<br>";
// echo $x--;
// echo "<br>";
// echo $x;
// echo "<br>";
// echo $y;
// echo "<br>";
// echo $x+=100;
// echo "<br>";
// echo $x-=100;
// echo"<br>";
// echo $x*=100;
// echo "<br>";
// echo $x/=100;
// echo "<br>";
// echo $x%=100;
// echo"<br>";
// echo $x**=100;
// echo "<br>";
// VAIABLES AND VALUES
// $characterName = "John";
// $characterAge =35;
// echo "There once was a man named xyzblog <br>";
// echo "He was 35 years old<br>";
// echo "He really liked the name xyzblog<br>";
// echo "But didn't like being 35<br>";
// $characterName = "xyzblog";
// $characterAge =35;
// echo "There once was a man named $characterName <br>";
// echo "He was $characterAge years old<br>";
// echo "He really liked the name $characterName<br>";
// echo "But didn't like being $characterAge<br>";
// $characterName = "Agi";
// $characterAge =30;
// echo "There once was a man named $characterName <br>";
// echo "He was $characterAge years old<br>";
// $characterName = "Mike";
// echo "He really liked the name $characterName<br>";
// echo "But didn't like being $characterAge<br>";
// DATA TYPES (STRINGS, INTEGERS, FLOATS, BOOLEANS, ARRAYS,OBJECTS, NULL, RESOURCE)
// 1.STRING DATA TYPE
// $phrase = "To be or not yo be";
// $age =30; //inter data type, it is a whole number
// $gpa =30.5; //float data type, it is a number with a decimal point
// $isMale = true; //boolean data type, it is a true or false value
// null; //null data type. it is a variable with no value
// echo $phrase;
// WORKING WITH STRINGS
$phrase = "Giraffe Academy";
// echo "$phrase<br>";
// chanhing data type to uppercase
// echo strtoupper($phrase);
echo "<br>";
// changing data type to lowercase
// echo strtolower($phrase);
echo "<br>";
// getting the lenght of the string
// echo strLen($phrase);
echo "<br>";
// getting the first character of the string
// echo $phrase[10];
echo "<br>";
// changing the first character of th string
// $phrase[0] = "B";
// echo $phrase;
echo "<br>";
// replacing a string with another string
// echo str_replace("Giraffe", "Panda", $phrase);
// echo"<br>";
// echo str_replace("affe", "Panda", $phrase);
// echo"<br>";
// getting the index of a character in a string
// echo strpos($phrase, "A");
// echo "<br>";
// echo strpos($phrase, "r");
// echo "<br>";
// echo strpos($phrase, "z");
// echo "<br>";
// echo substr($phrase, 8, 3);
// WORKING WITH NUMBERS
// echo 40
// echo "<br>";
// echo -40;
// echo "<br>";
// echo 40.5;
// echo "<br>";
// echo 5 + 9;
// echo "<br>";
// echo 5 + "9";
// echo "<br>";
// echo (4 + 5) * 10;
// echo "<br>";
// $num = 10;
// $num++;
// echo $num;
// echo "<br>";
// $num = 10;
// $num--;
// echo $num;
// echo "<br>";
// $num = $num + 25;
// echo $num;
// echo "<br>";
// $num += 25;
// echo $num;
// echo "<br>";
// $num = 10;
// echo abs(-100);
// echo "<br>";
// echo pow(2, 4);
// echo "<br>";
// echo sqrt(144);
// echo "<br>";
// echo max(2, 10);
// echo "<br>";
// echo min(2, 10);
// echo "<br>";
// echo round(3.7);
// echo "<br>";
// echo ceil(3.3);
// echo "<br>";
// echo floor(3.9);
// echo "<br>";
// GETTING USER INPUT IN PHP USING FORMS AND GET METHOD
// echo "<form active = 'lesson1.php' method = 'get'>";
// // echo "<input type = 'text' name = 'name'><br>";
// echo "<input type = 'submit'>";
// echo "</form>";
// echo $_GET["name"];
// GETTING USER INPUT IN PHP USING FORMS AND POST METHOD
// echo "<form active = 'lesson1.php' method = 'post'>";
// echo "<input type = 'text' name = 'name'><br>";
// echo "<input type = 'submit'>";
// echo "</form>";
// echo $_POST["name"];
// BUILDING A BASIC CALCULATOR
// echo "<form active = 'lesson1.php' method = 'post'>";
// echo " <input type = 'number' name = 'num1'><br>";
// echo " <input type = 'number' name = 'num2'><br>";
// echo "<input type = 'submit'>";
// echo "</form>";
// echo $_POST["num1"] **$_POST["num2"];
// BUILDING A MAD LIBS GAME
// echo "<form active = 'lesson1.php' method = 'post'>";
// // echo "color:<br> <input type = 'text' name = 'color'><br>";
// // echo "plural noun:<br> <input type = 'text' name = 'pluralNoun'><br>";
// // echo "celebrity:<br> <input type = 'text' name = 'celebrity'><br>";
// echo "<input type = 'submit'>";
// echo "</form>";
// $_color = $_GET["color"];
// $_pluralNoun = $_GETT["pluralName"];
// $_celebrity = $_GET["celebrity"];
// echo "Roses are $_color <br>";
// echo "$_pluralNoun are blue <br>";
// echo "I love $_celebrity <br>";
// ARRAYS
// $friends = array("kelvin", "kaunda", "kamau", "kamande");
// to print an array
// echo $friends[3];
// echo "<br>";
// to replace an element in a array
// $friends[0] = "wanyoike";   
// echo $friends [0];
// echo "<br>";
// TO ADD AN ELEMENT TO AN ARRAY
// $friends[4] = "Kamau";
// echo $friends[4];
// echo "<br>";
// TO GET THE LENGTH OF AN ARRAY
// echo count($friends);
// echo "<br>";
// TO PRINT AN ARRAY
// echo $friends;
// USING CHECKBOXES
// echo "<form active = 'lesson1.php' method = 'post'>";
// // echo "<input type = 'checkbox' name = 'friends[]' value = 'kelvin'><kelvin><br>";
// echo "<input type = 'checkbox' name = 'friends[]' value 
// = 'kaunda'><kaunda><br>";
// echo "<input type = 'checkbox' name = 'friends[]' value 
// = 'kamau'><kamau><br>";
// echo "<input type = 'checkbox' name = 'friends[]' value
// = 'kamande'><kamande><br>";
// echo "<input type = 'submit'>";
// echo "</form><br>";
// $friends = $_POST["friends"];
// echo $friends[1];
// echo "<br>";
// echo $friends[2];
// GET AND POST IN PHP
// ARRAY
// the var_dump help the php code to display the individual data type  and character length of an array. commenting the var_dump will give only the array depending on the index you echo
// $cars = array("volvo", "BMW", "Toyota", 12);
// var_dump($cars);
// echo $cars[1];
// echo "<br>";
// echo count($cars)
// the count gives the total data in the array
// $cars[1] = 'Ford';
// var_dump($car);

// $cars = array("volvo", "BMW", "Toyota", 12);
// foreach ($cars as $x){
    // echo "$x";
    // echo "<br>";
// }
// HOME PRACTICES
// $age = array("peter" => 35, "Ben" => 37, "Joe" => 47);
// foreach ($age as $x){
    // var_dump($age);
// echo"$x";
// echo "<br>";
// }
// FOREACH LOOP THIS IS USED TO ITERATE OVER ARRAY
// SYNTAX: FOREACH($ARRAY AS $VALUE){
//CODE TO EXECUTE
// }
// EXAMPLE OF FOREACH LOOP
// $fruits = array("Apple", "Banana", "Mango");
// foreach($fruits as $fruit){
    // echo "Fruit: $fruit<br>";
//} 
// ASOCIATIVE ARRAYS THIS IS USED TO STORE KEY VALUES PAIRS IN AN ARRAY
// SYNTAX: $ARRAY = ARRAY("KEY" => "VALUE", "KEY" => "VALUE");
// EXAMPLE OF ASSOCIATVE ARRAYS
// $student = array(
    // "Name" => "John Doe",
    // "Age" => 20,
    // "Grade" => "Junior"
// );
// $person = array("name" => "John", "age" => 30, "City" => "Port Harcourt");
// echo $person["name"];
// echo "<br>";
// echo $person['age'];
// echo "<br>";
// echo $person['City'];
// echo  $student["Name"];
// echo"<br>";
// echo  $student["Age"]; 
// echo "<br>";
// echo  $student["Grade"];
// echo "<br>";
// MULTI-DIMENSIONAL ARRAYS THIS IS USED TO STORE MULTIPLE ARRAYS IN AN ARRAY
// SYTAX: $ARRAY = ARRAY(ARRAY("VALUE", "VALUE"));
// EXAMPLE OF MULTI-DIMENSIONAL ARRAYS
// $students = array(
    // array("John", 20, "Junior"),
    // array("Jane", 21, "Senior"),
    // array("James", 22, "Freshman")
// );
// echo $students[0][2]
// FUNCTION
// function add($a, $b){
    // return $a + $b;
// }
// call the function and store the result
// $sum = add(5, 7);
// echo "The sum is: $sum";
// function calculateArea($length, $width){
// $area = $length * $width;
// return $area;
// }
// call the function
// $area = calculateArea(10, 5);
// echo "The area is: $area";
// function calculateVoulme($length, $width,$height){
    // $volume = ($length * $width) * $height;
    // return $volume;
// }
// call the function
// $volume = calculateVoulme (10, 5, 7);
// echo "The Volume is: $volume";
// WORKING WITH FORMS
// => FORM VALIDATION AND ERROR HANDLING
// HOW TO CONNECT MY DATABASE USING THE PDO
// 

?>
