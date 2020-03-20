## PHP Interview Questions and Answers



#### Q. After the code below is run, what are the values of `$a` and `$b`?

```php
    $a = '5';
    $b = &$a;
    $b = "2$b";
```
#### Q. Looking at the code below, what will the function `getTemplateName()` return?
```php
class Template
{
    protected $template_name;

    public function __construct() {
   	  $this->template_name = 'innovation_card';
    }

	public static function getTemplateName() {
      return $this->template_name;
	}
}
```
#### Q. Explain, line by line, what the following code does. Can it be improved? If so, how?
```php
function inline_tweet($content, $options)
{
    $url = get_url();
    $content = trim($content);
    $tweet = strlen($content) > 140 ? substr($content, 0, 140 - (strlen($url)) : $content;

	return sprintf(
    '<span class="%1$s">
      <a href="https://twitter.com/intent/tweet?text=%2$s&url=%3$s&via=%4$s" target="_blank">%5$s</a>
    <span>',
	$options['class'],
	urlencode($tweet),
	urlencode($url),
	'trendwatching',
	$content
	);
}
```

#### Q. What is PHP?
PHP or Hypertext Pre-processor is a general purpose programming language written in C and used by developers to create dynamic web applications. PHP Supports both Procedural Programming and Object Oriented Programming.

PHP files generally have extension .php and PHP code is generally written between `<?php ... ?>` tags. 
A hello world program is:
    
```php
<?php
    echo "hello world";
?>
```

#### Q. Is PHP case sensitive?

In PHP, variable names are case-sensitive but function names are not case sensitive. If we define function name in lowercase, but calling them in uppercase it will work. So, PHP can be called as partially case-sensitive language.

#### Q. Is PHP weakly typed language?

Yes, because we don’t need to mention the datatype of variables while declaring it. Variables are automatically type casted when the values are inserted in it.

#### Q. How do we install PHP?
PHP is a cross-platform language and we do have multiple choices to install PHP on different operating systems. We can download PHP from official website and install it or we can make use of popular bundles like XAMPP and WAMP for Windows, LAMP for Linux and MAMP for iOS.

#### Q. What is Composer?
Composer is an application-level package manager for the PHP applications that provides a standard system for managing dependencies of different libraries and others. Some of the features of composer are: 

- dependency resolution for PHP packages
- keeping all packages updated
- support autoloading out of the box
- hooks to execute pre and post commands

To manage dependencies, composer uses composer.json file, which looks like:

```javascript
{
    "autoload": {
        "psr-0": {
            "": "src/"
        }
    },
    "require": {
        "php": ">=5.3.2"
    },
    "config": {
        "bin-dir": "bin"
    }
}
```

#### Q. What is Packagist?

Packagist is the primary package repository for Composer. This is where developers publish their packages or libraries that can be used by other developers which are using composer.

#### Q. How do we execute a PHP script from the command line?

To execute PHP files from command line, we can use any CLI or shell and pass the .php file to the php executable. An example is below:

```bash
~ /path/to/php /path/to/script.php
```

#### Q. What is virtual host?

Virtual hosting is a method for hosting multiple domain names (with separate handling of each name) on a single server (or pool of servers). This allows one server to share its resources, such as memory and processor cycles, without requiring all services provided to use the same host name. 

#### Q. What are XAMPP & WAMP?

These are installable packages that can be used to setup development environments on windows machines easily.

WAMP: acronym for Windows Operating System, Apache(Web server), MySQL Database and PHP Language.
XAMPP: acronym for X (any Operating System), Apache (Web server), MySQL Database, PHP Language and PERL.

#### Q. What is Apache server?

Apache is a web server used to handle HTTP Request/Response. After we enable PHP module in Apache, it accepts HTTP requests from the client and passes it to PHP interpreter. PHP interpreter performs actions according to HTTP Request and sends back the response to Apache. Apache then wraps it as a HTTP response and sends back to client. 

#### Q. How to check current PHP version and other information about our system?

We can use function `php_info();` inside scripts and using command `php -v` from command line.


#### Q. What is interpreter?

PHP interpreter executes command from a PHP script line by line and provides the output to the executer.


#### Q. Is PHP compiled or interpreted?

Both, PHP is compiled down to an intermediate bytecode that is then interpreted by the runtime engine.

*PHP compiler* is responsible for:
- convert code to a bytecode that can be used by runtime engine.
- resolve functions, names and classes names
- creating symbol table

then, *PHP Interpretor* does: 
- Goes through the bytecode line by line and executes it
- Handles runtime exception

#### Q. What do we mean by a Framework?

A framework is a layered structure indicating what kind of programs can or should be built and how they would interrelate. Some computer system frameworks also include actual programs, specify programming interfaces, or offer programming tools for using the frameworks.
Example: Laravel, Zend, CakePHP

#### Q. What is MVC?

MVC is an application design pattern that separates the application data and business logic (model) from the presentation (view). MVC stands for Model, View & Controller. The controller mediates between the models and views.

#### Q. What is a datatype?

A data type is a classification that specifies which type of value a variable has and what type of mathematical, relational or logical operations can be applied to it without causing an error.

#### Q. How many datatypes are there?

Built-in datatypes in PHP:
**Integer** - whole numbers
**String** - alphanumeric text
**Float** - decimal point numbers(also called double)
**Boolean** - represents logical values(TRUE or FALSE)
**Array** - collection of elements having same datatype
**Object** - stores data and information on how to process that data
**NULL** - no value
**Resource** - stores a reference to functions and resources external to PHP

#### Q. What are rules for naming a variable?

Rules for naming a variable are following −

- Variable names must begin with a letter or underscore character.
- A variable name can consist of numbers, letters, underscores but you cannot use characters like + , - , % , ( , ) . & , etc.

#### Q. How will you define a constant?

To define a constant you have to use `define()` function and to retrieve the value of a constant, you have to simply specifying its name. Unlike with variables, you do not need to have a constant with a $.

```php
define("MINSIZE", 50);
echo MINSIZE;
```

#### Q. What is the purpose of constant() function?

As indicated by the name, this function will return the value of the constant. This is useful when you want to retrieve value of a constant, but you do not know its name, i.e. It is stored in a variable or returned by a function.

```php
define("MINSIZE", 50);
echo MINSIZE;
echo constant("MINSIZE"); // same thing as the previous line
```

Only scalar data (boolean, integer, float and string) can be contained in constants.

#### Q. What are the differences between constants and variables?

- There is no need to write a dollar sign ($) before a constant, where as in variable one has to write a dollar sign.
- Constants cannot be defined by simple assignment, they may only be defined using the `define()` function.
- Constants may be defined and accessed anywhere without regard to variable scoping rules.
- Once the constants have been set, may not be redefined or undefined.

#### Q. What are the different scopes of variables?

Variable scope is known as its boundary within which it can be visible or accessed from code. In other words, it is the context within which a variable is defined. There are only two scopes available in PHP namely local and global scopes.

- Local variables (local scope)
- Global variables (special global scope)
- Static variables (local scope)
- Function parameters (local scope)
When a variable is accessed outside its scope it will cause PHP error undefined variable.

#### Q. What is string?

A string is a data type used to represent text. It is a set of characters that can also contain spaces and numbers. For example, the word "Bootsity" and the phrase "Bootsity PHP Tutorials" are both strings.
To declare strings we can write:

```php
$string = "bootsity";
```

#### Q. What is the difference between single quoted string and double quoted string?

Singly quoted strings are treated almost literally, whereas doubly quoted strings replace variables with their values as well as specially interpreting certain character sequences.

```php
$variable = "name";
$stringEx = 'My $variable will not print!\\n';
print($stringEx);
$stringEx = "My $variable will print!\\n";
print($stringEx);
```

Output:

```
My $variable will not print!
My name will print
```

#### Q. How can you convert string into array elements?

`explode()` function breaks a string into an array. Each of the array elements is a substring of string formed by splitting it on boundaries formed by the string delimiter.

Syntax: 

```php
explode(separator,string,limit);
```

#### Q. How can you convert array into strings?
 
The `implode()` function returns a string from the elements of an array.
The `implode()` function accept its parameters in either order.
The separator parameter of `implode()` is optional. However, it is recommended to always use two parameters for backwards compatibility.

Syntax:

```php
implode(separator,array)
```

#### Q. How can you concatenate two or more strings?

To concatenate two string variables together, use the dot (.) operator.

Example:

```php
$string1 = "Hi! i am";
$string2 = "50";
echo $string1 . " " . $string2;
```

Output:

```
Hi! i am 50
```

#### Q. Differentiate between echo and print().

echo and print are more or less the same. They are both used to output data to the screen.

The differences are: 
- echo has no return value while print has a return value of 1 so it can be used in expressions. 
- echo can take multiple parameters (although such usage is rare) while print can take one argument. 
- echo is faster than print.


#### Q. Explain static variables.

When a function is completed, all of its variables are normally deleted.

However, sometimes you want a local variable to not be deleted then use static keyword.

Example:

```php
function Test() {		
	static $x = 0;		
	echo $x;		
	$x++;		
}			
Test();		
Test();		
Test();	
```

Output:
```
0 1 2
```

#### Q. What are PHP magic constants?

PHP provides a large number of predefined constants to any script which it runs known as magic constants. PHP magic constants start and end with underscore _

Example:

`_LINE_` gives the current line number of the file.

`_FILE_` denotes the full path and filename of the file. If used inside an include,the name of the included file is returned. Since PHP 4.0.2, `_FILE_` always contains an absolute path whereas in older versions it contained relative path under some circumstances.


#### Q. Why do we need trim() function?

The trim() function removes whitespaces or other predefined characters from either of the sides(beginning and ending) of a string.


#### Q. Can you count the number of words in a string?

The `str_word_count()` function counts the number of words in a string.

Example:

```php
echo str_word_count("Hello world!");
```

Output:
```
2
```

#### Q. How to reverse a string?

`strrev()` reverses a string.

Example:

```php
echo strrev("Hello World!");
```

Output:

```
!dlroW olleH
```

#### Q. How to find the position of a specific text in a string?

`strpos()` returns the position of the first occurrence of a string inside another string (case-sensitive). Also note that string positions start at 0, and not 1.

```php
echo strpos("I love Bootsity, PHP tutorials!","Bootsity");
```

Output:
```
7
```

#### Q. How can you change cases in a string?

The `strtoupper()` function converts a string to uppercase and `strtolower()` function converts a string to uppercase.

Example:

```php
echo strtoupper("Hello WORLD!") . PHP_EOL;
echo strtolower("Hello WORLD!");
```

Output:

```
HELLO WORLD!
hello world!
```

#### Q. Can you replace a substring?

The built-in function `str_replace()` replaces some characters in a string (case-sensitive).

Example:

```php
echo str_replace("world","Peter","Hello world!");
```

Here we have replaced the characters "world" in the string "Hello world!" with "Peter":

#### Q. Differentiate between str_replace() and str_ireplace().

The `str_ireplace()` function php is not sensitive rule and will treat "abc","ABC" all combination as a single. 
The `str_ireplace()` will be less faster becuse it need to convert to the same case. But the difference will be very little event in a large data.
The `str_replace()` function is a case sensitive which means that it replaces the string that exactly matches the string exactly.

#### Q. Differentiate between printf() and print().

`printf()` outputs a formatted string whereas `print()` outputs one or more strings.

Example:

```php
print "Hello world!";
```

Output:

```
Hello world!
```

Example:

```php
$number = 9;
$str = "Beijing";
printf("There are %u million bicycles in %s.", $number, $str);
```

Output:

```
There are 9 million bicycles in Beijing.
```

#### Q. Differentiate between strstr() & strchr() functions.

Both the functions finds the first occurrence of a string inside another string so there is no difference. both are alias of each other.

#### Q. Differentiate between strstr() and stristr().

`stristr()` and `strstr()` both finds the first occurrence of a string inside another string where stristr is case-insensitive but `strstr()` is case sensitive.

#### Q. Can you encode a string in PHP?

`string urlencode (string $str )` function is used to encode a string in PHP. This function is convenient when encoding a string to be used in a query part of a URL, as a convenient way to pass variables to the next page.


#### Q. Differentiate between strcmp() and strncmp().

Both the functions compare 2 strings(case-sensitive) but `strncmp()` compares the strings upto N numbers.

Example:

```php
echo strcmp("Hello world!","Hello earth!");
```

Output:

```
18 (As the strings are not fully same)
```

Example:

```php
echo strncmp("Hello world!","Hello earth!",6);
```

Output:

```
0 (As the strings are same upto first 6 characters)
```

#### Q. Is it possible to remove the HTML tags from data?

The `strip_tags()` function strips a string from HTML, XML, and PHP tags.

#### Q. What is the use of gettype() in PHP?

The `gettype()` is a predefined PHP function which is used to know the datatype of any variable.

#### Q. What is heredoc and nowdoc?

heredoc and nowdoc allows strings to be defined in more than one line without string concatenation. A nowdoc is specified similarly to a heredoc, but no parsing is done inside a nowdoc. The construct is ideal for embedding PHP code or other large blocks of text without the need for escaping.

heredoc example:

```php
$name = "Bootsity";

$here_doc = <<<EOT
This is $name website
for PHP, Laravel and Angular Tutorials

EOT;

echo $here_doc;
```

Output:

```
This is Bootsity website
for PHP, Laravel and Angular Tutorials
```

nowdoc example:

```php
$name = "Bootsity";

$here_doc = <<<'EOT'
This is $name website
for PHP, Laravel and Angular Tutorials

EOT;

echo $here_doc;
```

Output:

```
This is $name website
for PHP, Laravel and Angular Tutorials
```

#### Q. Explain if-else statement.

The if statement is a way to make decisions based upon the result of a condition. 
For example:

```php
$result = 70;
if ($result >= 57) {
	echo "Pass";
} else {
	echo "Fail";
}
```

Output:

```
Pass
```

#### Q. Explain switch statement with example.

Switch statement works same as if statements. However the difference is that they can check for multiple values. Also, you can do the same with multiple if..else statements, but this is not always the best approach.

```php
$flower = "rose";
switch ($flower) {
	case "rose" : 
 		echo $flower." costs $2.50";
 		break;
	case "daisy" : 
 		echo $flower." costs $1.25";
 		break;
	case "orchild" : 
 		echo $flower." costs $1.50";
 		break;
	default : 
 	    echo "There is no such flower in our shop";
 	break;
}
```

Output:

```
rose costs $2.50
```

#### Q. Differentiate between switch and if-else statement.

- **Check the testing expression**: An if-then-else statement can test expressions based on ranges of values or conditions, whereas a switch statement tests expressions based only on a single integer, enumerated value, or string.

- **switch is better for multi way branching**: When compiler compiles a switch statement, it will inspect each of the case constants and create a *jump table* that it will use for selecting the path of execution depending on the value of the expression. Therefore, if we need to select among a large group of values, a switch statement will run much faster than the equivalent logic coded using a sequence of if-elses. The compiler can do this because it knows that the case constants are all the same type and simply must be compared for equality with the switch expression, while in case of if expressions, the compiler has no such knowledge.

- **if-else is better for boolean values**: if-else conditional branches are great for variable conditions that result into a boolean, whereas switch statements are great for fixed data values.

- **Speed**: A switch statement might prove to be faster sometimes when there are more if-else in if-else ladder.

- **Clarity in readability**: A switch looks much cleaner when you have to combine cases. if-else are quite vulnerable to errors too. Missing an else statement can land you up in havoc. Adding/removing labels is also easier with a switch and makes your code significantly easier to change and maintain.


#### Q. What are the different types of operators?

1. Arithmetic operators
2. Assignment operators
3. Logical operators
4. Comparison operators
5. Unary operators

#### Q. Explain arithmetic operators.

| Operator      | Use           |
| ------------- |-------------|
| +      | to add numbers |
| -     | subtract two numbers      |
| * | to multiply two numbers      |
| / | to divide one number by another      |
| % | to divide two numbers and return the remainder |


#### Q. Explain the assignment operators.

`$a = 10;`

stores the value 10 in the variable $a

#### Q. Explain the logical operators.

| Operator      | Use           |
| ------------- |-------------|
| &&      | It returns true, if both expression1 and expression2 are true. |
| !     | It returns true, if expression is false.      |
| `||` | It returns true, if either expression1 or expression2 or both of them are true.     |


#### Q. Explain the unary operators.

| Operator      | Use           |
| ------------- |-------------|
| ++      | Used to increment the value of an operand by 1. |
| --     | Used to decrement the value of an operand by 1.      |

#### Q. Explain the comparison operators.

| Operator      | Use           |
| ------------- |-------------|
| ==      | Equals |
| !=     | Doesn't equal      |
| >     | Is greater than      |
| <     | Is less than      |
| >=     | Is greater than or equal to      |
| <=     | Is less than or equal to      |
| ===     | Identical (same value and same type)      |
| !==     | Not Identical      |


#### Q. Differentiate between === and == operators in PHP.

The operator == casts between two different types if they are different, while the === operator performs a typesafe comparison that means it will only return true if both operands have the same type and the same value.

Examples:

```php
1 === 1: true
1 == 1: true
1 === "1": false // 1 is an integer, "1" is a string
1 == "1": true // "1" gets casted to an integer, which is 1
"foo" === "foo": true // both operands are strings and have the same value
```

#### Q. Explain pre and post increment with example.

| Operator      | Use           | Explanation |
| ------------- |-------------|---------------|
| Pre-increment     | ++$a | increments $a by one, then returns $a. |
| Post-increment     | $a++ | returns $a, then increments $a by one. |
| Pre-decrement     | --$a | decrements $a by one, then returns $a. |
| Post-decrement     | $a-- | returns $a, then decrements $a by one. |


#### Q. What do you mean by operator overloading?

Operator overloading (less commonly known as ad-hoc polymorphism) is a specific case of polymorphism (part of the OO nature of the language) in which some or all operators like +, = or == are treated as polymorphic functions and as such have different behaviors depending on the types of its arguments. Operator overloading is usually only syntactic sugar. It can easily be emulated using function calls.

#### Q. How many loops are available in PHP?

There are several types of loops in PHP.

- while
- do-while
- for
- foreach

#### Q. Explain while loop with example.

- The while loop evaluates the test expression.
- If the test expression is true (nonzero), codes inside the body of while loop are executed. The test expression is evaluated again. The process goes on until the test expression is false.
- When the test expression is false, the while loop is terminated.

Example:

```php
$x = 1; 
while($x <= 5) {
    echo "The number is: $x <br>";
    $x++;
}
```

Output:

```
The number is: 1 
The number is: 2 
The number is: 3 
The number is: 4 
The number is: 5
```

#### Q. Explain do-while loop with example.

The do...while loop will always execute the block of code once, it will then check the condition, and repeat the loop while the specified condition is true.

Example:

```php
$x = 1; 
do {
	echo "The number is: $x <br>";
	$x++;
} while ($x <= 5);
```

In the above example, first a variable $x is set to 1 ($x = 1). Then, the do while loop will write some output, and then increment the variable $x with 1. Then the condition is checked (is $x less than, or equal to 5?), and the loop will continue to run as long as $x is less than, or equal to 5.

#### Q. Explain for loop with example.

```php
for (init counter; test counter; increment counter) {
	code to be executed;
}
``` 

loop has 3 arguments.
- init counter: Initialize the loop counter value
- test counter: Evaluated for each loop iteration. If it evaluates to TRUE, the loop continues. If it evaluates to FALSE, the loop ends.
- increment/decrement counter: Increases/decreases the loop counter value.

Example:

```php
for ($x = 0; $x <= 10; $x++) {
	echo "The number is: $x <br>";
} 
```

Output:

```
The number is: 0 
The number is: 1 
The number is: 2 
The number is: 3 
The number is: 4 
The number is: 5 
The number is: 6 
The number is: 7 
The number is: 8 
The number is: 9 
The number is: 10 
```

#### Q. Explain foreach loop with example.

The foreach provides an easy way to iterate over associative arrays. foreach works only on arrays and objects, and will issue an error when you try to use it on a variable with a different data type or an uninitialized variable. There are two syntaxes:

```php
foreach (array_expression as $value)
	statement

foreach (array_expression as $key => $value)
    statement
```

The first foreach loops over the array given by array_expression. On each iteration, the value of the current element is assigned to $value and the internal array pointer is advanced by one (so on the next iteration, you'll be looking at the next element).

The second form will additionally assign the current element's key to the $key variable on each iteration.

#### Q. How can you implement an infinite loop in PHP?

This 3 loops can be used to achieve infinite loops in PHP.
1. while
2. do-while
3. for

Examples:

```php
while (1)
//statement`

for (;;;)
//statement`

do {
//statement
}

while (1) {
}
```

In all the above 3 cases, the loops will execute infinite times as the condition is always true i.e., it returns 1 for `while` and `do-while` loops and no ending condition for the `for` loop.

#### Q. How can you implement recursion in PHP?

Recursion is the phenomenon of calling a function from within itself.

```php
function factorial($n) {
	// Base case
	if ($n == 0) {
		echo "Base case: \$n = 0. Returning 1...<br>";
    	return 1;
	}
		
	// Recursion
	echo "\$n = $n: Computing $n * factorial(".($n-1).")...<br>";
	$result = ($n * factorial($n-1));
	echo "Result of $n * factorial(" .($n-1).") = $result. Returning $result...<br>";
	return $result;
}

echo "The factorial of 5 is: " . factorial(5);
```

Output:
```
The factorial of 5 is: 120
```

#### Q. Differentiate between iteration and recursion.

- The primary difference between recursion and iteration is that is a recursion is a process, always applied to a function. The iteration is applied to the set of instructions which we want to get repeatedly executed.
- Recursion is usually much slower because all function calls must be stored in a stack to allow the return back to the caller functions. In many cases, memory has to be allocated and copied to implement scope isolation.

#### Q. Explain break statement with example.

When a break statement is encountered inside a loop, the loop is immediately terminated and the program control resumes at the next statement following the loop. It can be used to terminate a case in the switch statement.

Example:
```php
for ($a = 1; $a < 6; $a++) {
	echo $a;
	if ($a > 3) {
	    break;
	}
}
```

Output:

```
1234
```

#### Q. Explain continue statement with example.

The continue statement is used inside loops. When a continue statement is encountered inside a loop, control jumps to the beginning of the loop for next iteration, skipping the execution of statements inside the body of loop for the current iteration.

```php
for ($a = 1; $a < 6; $a++) {
	if ($a == 4) {
		continue;
	}
	echo $a;
}
```

Output:

```
1235 (As it skipped 4 due to the continue statement)
```

#### Q. Give example of declaration in php?

The declare construct is used to set execution directives for a block of code. The syntax of declare is similar to the syntax of other flow control constructs:

```php
declare(ticks=1);

// A function called on each tick event
function tick_handler() {
	echo "tick_handler() called\n";
}

register_tick_function('tick_handler');

$a = 1;
if ($a > 0) {
	$a += 2;
	print($a);
}
```

Output:
```
tick_handler() called tick_handler() called tick_handler() called 3tick_handler() called tick_handler() called
```

#### Q. What is require in PHP?
Require is identical to include except upon failure it will also produce a fatal E_COMPILE_ERROR level error. In other words, it will halt the script whereas include only emits a warning (E_WARNING) which allows the script to continue.

Syntax:
```php
require('somefile.php');
```

#### Q. What is an array?

An array is a data structure which is a collection of elements having same datatype stored in a contiguous memory location.

There are 3 types of arrays:

*Indexed or Numeric Arrays* : An array with a numeric index where values are stored linearly.

*Associative Arrays* : An array with a string index where instead of linear storage, each value can be assigned a specific key.

*Multidimensional Arrays* : An array which contains single or multiple array within it and can be accessed via multiple indices.

Example:

```php
$a = array(); // declaration
$cars = array("Volvo", "BMW", "Toyota"); // initialization
```

#### Q. How can you print an array in PHP?

1. Using print_r() method:

```php
$a = array ('a' => 'apple', 'b' => 'banana', 'c' => array ('x', 'y', 'z'));
print_r ($a);
```

Output:

```php
Array
(
    [a] => apple
    [b] => banana
    [c] => Array
        (
            [0] => x
            [1] => y
            [2] => z
        )
)
```

2. Using var_dump() method: This method is good at the time of debugging.

```php
$a = array(1, 2, array("a", "b", "c"));
var_dump($a);
```

Output:

```php
array(3) {
	[0]=>
	int(1)
	[1]=>
	int(2)
	[2]=>
	array(3) {
    [0]=>
    string(1) "a"
    [1]=>
    string(1) "b"
    [2]=>
    string(1) "c"
	}
}
```

#### Q. What do we mean by the base address of an array?

The base address of an array is the memory location of the first element present in the array i.e., the 0th index element.

#### Q. What do we mean by keys and values?

In associative arrays, we can use named keys that you assign to them.
There are two ways to create an associative array: 

```php
// first way -

$age = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");`

// another method - 
$age['Peter'] = "35"; //Peter, Ben & Joe are keys
$age['Ben'] = "37"; //35, 37 & 43 are values
$age['Joe'] = "43";
```

#### Q. What are the keys & values in an indexed array?

```php
Array ( [0] => Hello [1] => world [2] => It's [3] => a [4] => beautiful [5] => day)
```

The keys of an indexed array are 0, 1, 2 etc(the index values) and values are "Hello", "world", "It's", "beautiful", "day".

#### Q. How can we convert array into string?

The implode() function returns a string from the elements of an array.
The implode() function accept its parameters in either order. However, for consistency with explode(), you should use the documented order of arguments.

Example:

```php
$arr = array('Hello','World!','Beautiful','Day!');
echo implode(" ",$arr);
```

Output:

```
Hello World! Beautiful Day!
```

#### Q. How can we convert a string into an array elements?

The explode() function breaks a string into an array.

Syntax:

```php
explode(separator,string,limit)
```

The "separator" parameter cannot be an empty string.

Example:

```php
$str = "Hello world. It's a beautiful day.";
print_r (explode(" ",$str));
```

Output:

```
Array (
        [0] => Hello 
        [1] => world. 
        [2] => It's 
        [3] => a 
        [4] => beautiful 
        [5] => day.
    )
```

#### Q. How can we concatenate arrays in PHP?

Using the `array_merge()` method. The array_merge() function merges one or more arrays into one array.

Example:

```php
$a1 = array("red", "green");
$a2 = array("blue", "yellow");
print_r(array_merge($a1, $a2));
```

Output:

```php
Array (
    [0] => red 
    [1] => green 
    [2] => blue 
    [3] => yellow
    );
```

#### Q. Which function counts all the values of an array?

`array_count_values()` function is used to count all the values of an array. PHP `array_count_values()` returns an array that has the values of given array as keys and their frequency in the array as values.

#### Q. How can we check if an element exists in an array?

The `in_array()` function is used to search for the given string in an array. It returns TRUE if the given string is found in the array, and FALSE otherwise.

#### Q. Which function inserts an element to the end of an array?

PHP `array_push()` function is used to insert one or more elements to the end of an array.

#### Q. What is the use of array_chunk() function?

The `array_chunk()` function is used to split an array into parts or chunks of new arrays.

Example:

```php
array_chunk(array,size);
```

The first parameter specifies an array and the second parameter defines the size of each chunk.

#### Q. Why do we use extract()?

The `extract()` function imports variables into the local symbol table from an array.
This function uses array keys as variable names and values as variable values. For each element it will create a variable in the current symbol table.
This function returns the number of variables extracted on success.

Example:

```php
$a = "Original";
$my_array = array("a" => "Cat","b" => "Dog", "c" => "Horse");
extract($my_array);
echo "\$a = $a; \$b = $b; \$c = $c";
```

Output:

```
$a = Cat; $b = Dog; $c = Horse
```


#### Q. What is a function?

A named section of a program that performs a specific task is called a function. In this sense, a function is a type of procedure or routine.

#### Q. What are the different types of functions?

1. Built-in functions
2. User defined functions

#### Q. Classify function on basis of parameters.

1. Non parameterized function
2. Parameterized function

#### Q. Differentiate between parameterized and non parameterized functions.

- Non parameterized functions don't take any parameter at the time of calling.
- Parameterized functions take one or more arguments while calling. These are used at run time of the program when output depends on dynamic values given at run time
There are two ways to access the parameterized function:
1. call by value : (here we pass the value directly )
2. call by reference : (here we pass the address location where the value is stored)

#### Q. Does PHP support both call by cvalue and call by reference?

Yes.

#### Q. Explain call by value.

In case of PHP call by value, actual value is not modified if it is modified inside the function.

Example:

```php  
function adder($str2) {  
    $str2 .= 'Call By Value';  
}  
$str = 'Hello ';  
adder($str);  
echo $str;  
```

Output:

```
Hello
```

#### Q. Explain call by reference.

In case of call by reference, actual value is modified if it is modified inside the function. In such case, we need to use `&` symbol with formal arguments. The & represents reference of the variable.

Example:

```php  
function adder(&$str2) {  
    $str2 .= 'Call By Reference';  
}
$str = 'This is ';  
adder($str);  
echo $str;  
```

Output:
```
This is Call By Reference
```

#### Q. What are the function declaration rules?

A valid function name starts with a letter or underscore, followed by any number of letters, numbers, or underscores.

#### Q. How can we declare user defined functions?

Using the `function` keyword.

Example:
```php
function foo($arg_1, $arg_2, /* ..., */ $arg_n) {
    echo "Example function.\n";
    return $retval;
}
```

#### Q. What do we mean by actual and formal parameters?

Arguments which are mentioned in the function call is known as the actual arguments. For example:

`func1(12, 23);`

here 12 and 23 are actual arguments.
Actual arguments can be constant, variables, expressions etc.

Arguments which are mentioned in the definition of the function is called formal arguments. Formal arguments are very similar to local variables inside the function. Just like local variables, formal arguments are destroyed when the function ends.

```php
function factorial($n) {
    // write logic here
}
```
Here n is the formal parameters.

#### Q. Maximum how many arguments are allowed in a function in PHP?

There is no limit but you can use `func_get_args()`, `func_get_arg()` and `func_num_args()` to avoid writing all the arguments in the function definition.

#### Q. Explain header().

The header() function sends a raw HTTP header to a client.

Syntax:

```php
header(string,replace,http_response_code)
```

Here the `string` specifies the header string to send.

#### Q. What do we mean by return type of a function?

The return type is similar to a datatype of a function. The common return types are: int, string, float, boolean etc. All the functions don't always need to have a return type.

#### Q. What is the return type of a function that doesn't return anything?

`void` which mean nothing.

#### Q. Do we need to mention the return type of a function explicitly in PHP?

No need to specify return type upon declaration but needs to use `return` statement within the body of the function.

#### Q. What is function that can be used to build a function that accepts any number of arguments?

`func_num_args()` returns the number of arguments passed to the function.
`func_get_args(void)`
Gets an array of the function's argument list.

#### Q. Explain the `return` statement.

return statement immediately terminates the execution of a function when it is called from within that function.
If no parameter is supplied	NULL is returned.

#### Q. Can we use multiple return statements in a function?

Yes but not in consecutive lines. We should then use the statements upon different conditions otherwise it will throw an error.

Example:
```php
function demo() {
    if (condition)
        return expression1;
    else
        return expression2;
}
```

#### Q. What is the use of ini_set()?

PHP allows the user to modify some of its settings mentioned in php.ini using ini_set(). This function requires two string arguments. First one is the name of the setting to be modified and the second one is the new value to be assigned to it.

Given line of code will enable the display_error setting for the script if it’s disabled.

`ini_set('display_errors', '1');`

We need to put the above statement, at the top of the script so that, the setting remains enabled till the end. Also, the values set via ini_set() are applicable, only to the current script. Thereafter, PHP will start using the original values from php.ini.

#### Q. What is the difference between unlink and unset functions?

`unlink()` function is useful for file system handling. We use this function when we want to delete the files (physically). Example:

```php
$xx = fopen('sample.html', 'a');
fwrite($xx, '<h1>Hello !!</h1>');
fclose($xx);
unlink('sample.html');
```

`unset()` function performs variable management. It makes a variable undefined. Or we can say that unset() changes the value of a given variable to null. Thus, in PHP if a user wants to destroy a variable, it uses unset(). It can remove a single variable, multiple variables, or an element from an array. Let’s see a sample code.

```php
$val = 200;
echo $val; // Output will be 200
$val1 = unset($val);
echo $val1; // Output will be null
```

```php
unset($val);  // remove a single variable
unset($val1, $val2, $val3); // remove multiple variables
```

#### Q. How ereg() function works?

The ereg() function searches a string specified by string for a string specified by pattern, returning true if the pattern is found, and false otherwise.

#### Q. How eregi() function works?

eregi() − The eregi() function searches throughout a string specified by pattern for a string specified by string. The search is not case sensitive.

#### Q. What is the purpose of getdate() function?

The function getdate() optionally accepts a time stamp and returns an associative array containing information about the date. If you omit the time stamp, it works with the current time stamp as returned by time().

#### Q. What is the purpose of date() function?

The date() function returns a formatted string representing a date. You can exercise an enormous amount of control over the format that date() returns with a string argument that you must pass to it.

#### Q. How will you call member functions of a class?

After creating your objects, you will be able to call member functions related to that object. One member function will be able to process member variable of related object only. Following example shows how to set title and prices for the three books by calling member functions.

```php
$physics−>setTitle("Physics for High School");
$chemistry−>setTitle("Advanced Chemistry");
$maths−>setTitle("Algebra");
$physics−>setPrice(10);
$chemistry−>setPrice(15);
$maths−>setPrice(7);
```


#### Q. How can we display the correct URL of the current webpage?

```php
echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; 
```
gives us the entire URL of the current webpage.

#### Q. How to get the information about the uploaded file in the receiving script?

```php
$_FILES[$fieldName]['name'] // The Original file name on the browser system. 
$_FILES[$fieldName]['type'] // The file type determined by the browser. 
$_FILES[$fieldName]['size'] // The Number of bytes of the file content. 
$_FILES[$fieldName]['tmp_name'] // The temporary filename of the file in which the uploaded file was stored on the server. 
$_FILES[$fieldName]['error'] // The error code associated with this file upload.
```

#### Q. What do we mean by server?

A server is a computer program that provides a service to another computer programs (and its user).
In the client/server programming model, a server program awaits and fulfills requests from client programs, which may be running in the same or other computers.

#### Q. What is a client?

A client is the receiving end of a service or the requestor of a service in a client/server model type of system. The client is most often located on another system or computer, which can be accessed via a network. This term was first used for devices that could not run their own programs, and were connected to remote computers that could via a network.

#### Q. What do you mean by a response?

Response to an event or to something that is generated according to the request from the client side to the server.

#### Q. What is HTTP?

The Hypertext Transfer Protocol (HTTP) is designed to enable communications between clients and servers.

HTTP works as a request-response protocol between a client and server.
A web browser may be the client, and an application on a computer that hosts a web site may be the server.

Example: A client (browser) submits an HTTP request to the server; then the server returns a response to the client. The response contains status information about the request and may also contain the requested content.

#### Q. What are PHP superglobals?

Several predefined variables in PHP are "superglobals", which means that they are always accessible, regardless of scope - and you can access them from any function, class or file without having to do anything special.

The PHP superglobal variables are:

$GLOBALS
$_SERVER
$_REQUEST
$_POST
$_GET
$_FILES
$_ENV
$_COOKIE
$_SESSION

#### Q. How will we get information sent via GET method?

The PHP provides `$_GET` associative array to access all the sent information using GET method.

#### Q. How will you get information sent via POST method?

The `$_POST` associative array to access all the sent information using POST method.

#### Q. What is the purpse $_REQUEST variable?

The PHP `$_REQUEST` variable contains the contents of both `$_GET`, `$_POST`, and `$_COOKIE`. The PHP $_REQUEST variable can be used to get the result from form data sent with both the GET and POST methods.

#### Q. What is the purpose of $_FILES variable?

This is a global PHP variable. This variable is an associate double dimension array and keeps all the information related to uploaded file.

#### Q. What is the purpose of $GLOBALS variable in PHP?

It contains a reference to every variable which is currently available within the global scope of the script. The keys of this array are the names of the global variables.

#### Q. What is the purpose of $_SERVER variable in PHP?

$_SERVER − This is an array containing information such as headers, paths, and script locations. The entries in this array are created by the web server. There is no guarantee that every web server will provide any of these. See next section for a complete list of all the SERVER variables.

#### Q. What is the purpose of $_COOKIE variable in PHP?

An associative array of variables passed to the current script via HTTP cookies.

#### Q. What do you mean by environment variable in PHP?

- PHP environment variables allow your scripts to glean certain types of data dynamically from the server. ...
- You can access these variables using the `$_SERVER` and `$_ENV` arrays.

#### Q. What is the purpose of $_ENV variable in PHP?

$_ENV is a superglobal that contains environment variables. Environment variables are provided by the shell under which PHP is running, so they may vary according to different shells.

#### Q. What is the purpose of $_SESSION variable in PHP?

$_SESSION − An associative array containing session variables available to the current script.

#### Q. How will you redirect a page?

The header() function supplies raw HTTP headers to the browser and can be used to redirect it to another location. The redirection script should be at the very top of the page to prevent any other part of the page from loading. The target is specified by the Location: header as the argument to the header() function. After calling this function the exit() function can be used to halt parsing of rest of the code.

#### Q. What is the purpose `$_PHP_SELF` variable?

The default variable `$_PHP_SELF` is used for the PHP script name and when you click "submit" button then same PHP script will be called.

#### Q. How will you get the browser's details using PHP?

One of the environment variables set by PHP is `HTTP_USER_AGENT` which identifies the user's browser and operating system.

#### Q. What do you mean by HTTP status codes?

Status codes are issued by a server in response to a client's request made to the server. The first digit of the status code specifies one of five standard classes of responses. The message phrases shown are typical, but any human-readable alternative may be provided.

#### Q. What are the HTTP client error codes?

The HTTP client error codes start with 4. Example: 404 is used for 'not found' status.

#### Q. What are the informational status codes?

1xx: Informational
It means the request has been received and the process is continuing.


#### Q. What are the HTTP success codes?

2xx: Success
It means the action was successfully received, understood, and accepted.


#### Q. How do you get the redirection related information?

3xx: Redirection
It means further action must be taken in order to complete the request.


#### Q. What are the HTTP client error codes?

4xx: Client Error
It means the client sent an invalid request.

#### Q. What are the HTTP server error codes?

5xx: Server Error
It means the server failed to fulfill an apparently valid request.


#### Q. What is API?

Application Program Interface is a set of functions and procedures that allow the creation of applications which access the features or data of an operating system, application, or other service.

#### Q. What is the use of an API?

Basically, an API specifies how software components should interact. Additionally, APIs are used when programming graphical user interface (GUI) components. A good API makes it easier to develop a program by providing all the building blocks. A programmer then puts the blocks together.

#### Q. What are types of API?

Most often-used types of web service:
1. SOAP.
2. XML-RPC.
3. JSON-RPC.
4. REST.

#### Q. What is REST API?

REST stands for "REpresentational State Transfer". It is a concept or architecture for managing information over the internet. REST concepts are referred to as resources. A representation of a resource must be stateless. It is usually represented by JSON.
API stands for "Application Programming Interface". It is a set of rules that allows one piece of software application to talk to another. Those "rules" can include create, read, update and delete operations.

#### Q.  Why do we need REST API?

In many applications, REST API is a need because this is the lightest way to create, read, update or delete information between different applications over the internet or HTTP protocol. This information is presented to the user in an instant especially if you use JavaScript to render the data on a webpage.

#### Q. Where REST API is used?

REST API can be used by any application that can connect to the internet. If data from an application can be created, read, updated or deleted using another application, it usually means a REST API is used.

#### Q. What is JSON?

JSON: JavaScript Object Notation.
JSON is a syntax for storing and exchanging data.
JSON is text, written with JavaScript object notation.

#### Q. Why do we need JSON?

1. For sending data
2. For receiving data

#### Q. How can you exchange data using JSON?

While exchanging data between a browser and a server, the data can only be text.
JSON is text, and we can convert any JavaScript object into JSON, and send JSON to the server.
We can also convert any JSON received from the server into JavaScript objects.
This way we can work with the data as JavaScript objects, with no complicated parsing and translations.

#### Q. Differentiate between JSON & XML.

1. JSON doesn't use end tag
2. JSON is shorter
3. JSON is quicker to read and write
4. JSON can use arrays
5. XML has to be parsed with an XML parser. JSON can be parsed by a standard JavaScript function
 
#### Q. What are the advantages of JSON?

JSON is easier to parse. JSON follows simple steps like:
1. Fetch a JSON string
2. JSON.Parse the JSON string

Using XML:

1. Fetch an XML document
2. Use the XML DOM to loop through the document
3. Extract values and store in variables


#### Q. What is Session?

A session is a temporary and interactive information interchange between two or more communicating devices, or between a computer and user. Session is stored at the server side.

#### Q. What is Cookie?

Cookie is a small text file (generally up to 4KB) created by a website that is stored in the user's computer either temporarily for that session only or permanently. Cookies provide a way for the website to recognize you and keep track of your preferences and other functionalities like shopping cart.

#### Q. Differentiate between Session & Cookie.

| Cookies      | Sessions           |
| ------------- |-------------|
| stored in browser as text file.      | server side |
| can store limited data     | can store unlimited data      |
| data is on client side and hence easily accessible | data is on server side and is difficult ot access      |


#### Q. How do we start a session?

Using `session_start()` method at the beginning of the script.

#### Q. How can we set session variable?

Session variables are set with the PHP global variable $_SESSION

Example:

```php
// Set session variables
$_SESSION["favcolor"] = "green";
$_SESSION["favanimal"] = "cat";
echo "Session variables are set.";
```

#### Q. How to destroy a session?

Using `session_destroy()` method at the end of the script.

#### Q. How to remove value from session variable?

`session_unset()` method

#### Q. When do we need to set session variables?

When a particular user signs in, adds items to cart - to track the particular user activity.
Session variables must be set after using `session_start();`

#### Q. When do we need a session and not a cookie?

- Cookies are stored on the client side, so they can be viewed, edited and deleted by the user. So be careful to not store and sensitive information on cookies.
Sessions are used when more sensitive information like password or id is being passed. Sessions are not accessible by users and hence more secure.
- You want to store important information such as the user id more securely on the server where malicious users cannot temper with them.
- You want to pass values from one page to another.
- You want the alternative to cookies on browsers that do not support cookies.
- You want to store global variables in an efficient and more secure way compared to passing them in the URL
You are developing an application such as a shopping cart that has to temporary store information with a capacity larger than 4KB.

#### Q. When do we need a cookie and not a session?

- Http is a stateless protocol; cookies allow us to track the state of the application using small files stored on the user’s computer.

The path were the cookies are stored depends on the browser.

Internet Explorer usually stores them in Temporal Internet Files folder.

- Personalizing the user experience – this is achieved by allowing users to select their preferences.

- The page requested that follow are personalized based on the set preferences in the cookies.

- Tracking the pages visited by a user

- Also, cookies last longer than that of a session.

#### Q. How can we set a cookie?

Using 
`setcookie(name, value, expire, path, domain, secure, httponly);`

#### Q. How to modify a cookie value?

To modify a cookie, just set (again) the cookie using the setcookie() function.

#### Q. How will we make a check that a cookie is set or not?

You can use isset() function to check if a cookie is set or not.

#### Q. How to retrieve all cookie values?

```php 
print_r($_COOKIE);
```

Output:
```
Array ([user] => abhi [age] => 25 [profile] => developer)
```

#### Q. How to delete a cookie?

When deleting a cookie you should assure that the expiration date is in the past.

```php
// set the expiration date to one hour ago
setcookie("user", "abhi", time()-60*60);
```

#### Q. How can we implement 'remember me' using PHP?

As the name indicate the meaning that cookies are the method to store the information of a web
page in a remote browser,those information can be retrieved form the browser itself,when the
same user comes back to that page.

The browser stores the message in a small text file that the server embeds on the user’s system.You can set cookies using the setcookie()function.

PHP transparently supports HTTP cookies,so setcookie() must be called before any
output is sent to the browser.

#### Q. Classify cookies.

There are 2 types of cookies: 
1. Session Based which expire at the end of the session.
2. Persistent cookies which are written on harddisk.

#### Q. How will you delete a cookie?

To delete a cookie you should call setcookie() with the name argument only.

#### Q. How to track login and logout using PHP?

Session variable must be set when a user logs in and session needs to be destroyed upon logout.

#### Q. How to create a file?

`touch()` function is used to create a file.

Example:

```php
// create text file
touch("data.txt");
```

#### Q. What are the other way to write in a file?

An alternative way to write data to a file is to create a file pointer with `fopen()`, and then write data to the pointer using PHP’s `fwrite()` function.

Example:

```php
// open and lock file 
$fo=fopen("output.txt","w");
flock($fo,LOCK_EX) or die('ERROR:cannot lock file');

// write string to file
$data="A fish out of water";
fwrite($fo, $data);

// unlock and close file
flock($fo,LOCK_UN) or die('ERROR:cannot unlock file');
fclose($fo);
echo "Data written to file";
```

#### Q. How will you check if a file exists or not using php?

File's existence can be confirmed using `file_exist()` function which takes file name as an argument.

#### Q. How to delete a file?

unlink( ) function is used to delete a file.

Example:
```
// delete text file
unlink("data.txt");
```

#### Q. How to copy a file?

Example:
```php
// copy text file
copy("data.txt","update data.txt");
```

#### Q. How to rename file?

`rename()` function is used to rename file.

Example:
```php
// rename text file
rename("data.txt","update data.txt");
```


#### Q. How to check whether a file or directory exists?

`file_exists()` function is used to check file or directory existence.

Example:
```php
// check file existence
echo file_exists("Update resume.doc");
```

Output: 
```
1
```

#### Q. How to check path of the file in PHP?

`realpath()` function is used to check real path of the file.

Example:
```php
// check real path of the file
echo realpath("Update resume.doc");
```

#### Q. How to check size of the file in PHP?

The files length can be found using the `filesize()` function which takes the file name as its argument and returns the size of the file expressed in bytes.

Example:
```php	
// check file size
echo filesize("notes.txt")." Bytes";
```

Output:
```
190 Bytes
```

#### Q. How to write the contents inside file?

`file_put_contents()` accepts a filename and path, together with the data to be written to the file, and then writes the latter to the former

Example:
```php
// write string to file
$data = "A fish out of water";
file_put_contents("output.txt", $data) or die('ERROR: Can not write file');
echo "data written inside  this file";
```

#### Q. Explain `file()` method.

A way of reading data from a file is file() function, which accepts the name and path to a file and reads the entire file into an array,
with each element of the array representing one line of the file.
Here’s an example which reads a file into an array and then displays it using foreach loop.

Example:
```php
// read file into array
$arr = file('output.txt') or die('ERROR: cannot file file');
foreach ($arr as $line) {
    echo $line;
} 
```

#### Q. How To change the file permissions?

Permissions in PHP are very similar to UNIX. Each file has following three types of permissions.
- Read
- Write and
- Execute.
PHP uses the `chmod()` function to change the permissions of a specific file. It returns TRUE on success and FALSE on failure.

Following is the Syntax:
```
chmod(file,mode)
```

#### Q. What are different ways to get the extension of a file?

There are following two ways to retrieve the file extension.

```php
$filename = $_FILES['image']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);`
```

#### Q. How to create a directory using PHP?

Example:

```php
 mkdir("mydocs");
```

In this program we use mkdir()function . Pass the directory name inside this function to create the directory.

#### Q. How to get files(contents) from directory?

```php
$files =  scandir("mydocs");
print_r($files);
```
in the above example we get the contents of a directory. use scandir() function , directory name declare inside this.
scandir() function returns the files in array so stored the return value in a variable( $files).
Now print this using print_r($files) function i.e specially used to print the value and index of array.
it gives an output of an array type with index and their corresponding value.

#### Q. How to open a directory?

```php
$od =  openddir("mydocs");
```

In the above example if we open the directory use opendir() function with directory name (“mydocs”).
store in variable $files because these open directory variable is going to used in further communication(for reading the contents).

#### Q. What is include in php?

Files are included based on the file path given or, if none is given, the `include_path` specified. If the file isn't found in the include_path, include will finally check in the calling script's own directory and the current working directory before failing. The include construct will emit a warning if it cannot find a file; this is different behavior from require, which will emit a fatal error.

If a path is defined — whether absolute (starting with a drive letter or \ on Windows, or / on Unix/Linux systems) or relative to the current directory (starting with . or ..) — the include_path will be ignored altogether. For example, if a filename begins with ../, the parser will look in the parent directory to find the requested file.


#### Q. What is require_once in php?

The require_once statement is identical to require except PHP will check if the file has already been included, and if so, not include (require) it again.

"require_once" and "require" are language constructs and not functions. Therefore they should be written without "()" brackets!

#### Q. What is include_once in php?

The `include_once` statement includes and evaluates the specified file during the execution of the script. This is a behavior similar to the include statement, with the only difference being that if the code from a file has already been included, it will not be included again, and "include_once" returns TRUE. As the name suggests, the file will be included just once.

include_once may be used in cases where the same file might be included and evaluated more than once during a particular execution of a script, so in this case it may help avoid problems such as function redefinitions, variable value reassignments, etc.

#### Q. What is require() in PHP?

require() statement takes all the text/code/markup that exists in the specified file and copies it into the file that uses the include statement.
require will produce a fatal error (`E_COMPILE_ERROR`) and stop the script.

#### Q. What is difference between require and include?

The require() function is identical to include(), except that it handles errors differently. If an error occurs, the include() function generates a warning, but the script will continue execution. The require() generates a fatal error, and the script will stop.


#### Q. What is RegEx?

RegEx or Regular Expressions is a way to express how a computer program should look for a specified pattern in text and then what the program is to do when each pattern match is found. 
For example, a regular expression could tell a program to search for all text lines that contain the word "Windows 95" and then to print out each line in which a match is found or substitute another text sequence (for example, just "Windows") where any match occurs.

#### Q. Why do we need RegEx?

- Regular expressions simplify identifying patterns in string data by calling a single function. This saves us coding time.
- When validating user input such as email address, domain names, telephone numbers, IP addresses,
Highlighting keywords in search results
- When creating a custom HTML template. Regular expressions can be used to identify the template tags and replace them with actual data.

#### Q. How preg_match() function works?

The preg_match() function searches string for pattern, returning true if pattern exists, and false otherwise.

```php
$my_url = "www.bootsity.com";
echo preg_match("/boot/", $my_url); // prints true
```

#### Q. Regualar Expression Notations.

| Expression      | Description           |
| ------------- |-------------|
| p+      | matches any string containing at least one p. |
| p*     | matches any string containing zero or more p's.      |
| p? | matches any string containing zero or one p's.      |
| p{N} | matches any string containing a sequence of N p's      |
| p{2,3} | matches any string containing a sequence of two or three p's.      |
| p{2, } | matches any string containing a sequence of at least two p's.      |
| p$ | matches any string with p at the end of it.     |
| ^p | matches any string with p at the beginning of it.     |


#### Q. Regualar Expression Examples.

| Expression      | Description           |
| ------------- |-------------|
| [^a-zA-Z]      | matches any string not containing any of the characters ranging from a through z and A through Z. |
| p.p    | matches any string containing p, followed by any character, in turn followed by another p.     |
| ^.{2}$ | matches any string containing exactly two characters.     |
| <b>(.*)</b> | It matches any string enclosed within <b> and </b>.      |
| p(hp)* | matches any string containing a p followed by zero or more instances of the sequence php.      |


#### Q. What is OOPs?

Object Oriented Programming(OOPs) is a programming approach based upon objects and data. In OOP approach, we create templates known as classes and then create their runtime instances known as objects.


#### Q. What is an object?

Object is a real life entity which has an identity and behaviour. Each object is an instance of a particular class or subclass with the class's own methods or procedures and data variables.

#### Q. How can we create object of a class?

Once we define our class, we can create as many objects as we like of that class type. Following is an example of how to create object using new operator.

```php
$physics = new Books();
$maths = new Books();
$chemistry = new Books();
```

#### Q. What is a class?

A class is a template that is used to create objects, and to define object data types and methods. Core properties include the data types and methods that may be used by the object. All class objects should have the basic class properties.

#### Q. What are the basic features of OOPs?

1. Abstraction
2. Encapsulation
3. Polymorphism
4. Inheritance

#### Q. Is PHP purely an object oriented language?

No, PHP is not purely object oriented. PHP supports object oriented approach as well as procedural approach.

#### Q. Differentiate between OOPs & POPs.

| OOPs      | POPs           |
| ------------- |-------------|
| Takes bottom-up approach.      | Follows top-down approach |
| Program is divided into objects     | Program is divided into functions      |
| Each objects control it's own data | Here, data is global      |
| Data hiding and inheritance are available | No such features are there      |
| Java, C++ | Pascal, Fortran    |


#### Q. What is generalization?

Generalization is the process of extracting shared characteristics from two or more classes, and combining them into a generalized superclass. Shared characteristics can be attributes, associations, or methods.

#### Q. What is specialization?

Specialization is the reverse process of Generalization means creating new sub classes from an existing class.

#### Q. What is aggregation?

Aggregation is a relationship between two classes that is best described as a "has-a" and "whole/part" relationship. It is a more specialized version of the association relationship. The aggregate class contains a reference to another class and is said to have ownership of that class.

#### Q. What is composition?

Composition is a special case of aggregation. In other words, a restricted aggregation is called composition. When an object contains the other object and the contained object cannot exist without the other object, then it is called composition.

#### Q. What is association?

The association relationship indicates that a class knows about, and holds a reference to, another class. Associations can be described as a "has-a" relationship.

#### Q. What is abstraction?

An abstraction denotes the essential characteristics of an object that distinguish it from all other kinds of objects and thus provide crisply defined conceptual boundaries, relative to the perspective of the viewer.

#### Q. What is encapsulation?

Encapsulation is the process of binding both attributes and methods together within a class. Through encapsulation, the internal details of a class can be hidden from outside. The class has methods that provide user interfaces by which the services provided by the class may be used.

#### Q. What is inheritance?

Inheritance is a mechanism wherein a new class is derived from an existing class where a class inherits or acquires the properties and methods of other classes. 

#### Q. What is super class?

The class from which it's derived is called the superclass.

#### Q. What is a sub class?

The derived class (the class that is derived from another class) is called a subclass.

#### Q. How can you inherit a class in PHP?

We declare a new class with additional keyword `extends`.

#### Q. What is a constructor?

If a class name and function name will be similar in that case function is known as constructor.

Constructor is special type of method because its name is similar to class name.

Constructor automatically calls when object will be initializing.

#### Q. Explain __construct().

By using this function we can define a constructor.

It is known as predefined constructor. Its better than user defined constructor because if we change class name then user defined constructor treated as normal method.

If predefined constructor and user defined constructor, both are defined in the same class, then predefined constructor will be treated as a Constructor while user defined constructor treated as normal method.

#### Q. Classify constructor.

1. Default constructor
2. Parameterized constructor
3. Copy constructor

#### Q. What is a destructor?

The Destructor method will be called as soon as there are no other references to a particular object, or in any order during the shutdown sequence.
 __destruct() is used to define destructor.

#### Q. Explain $this.

To access or change a class method or property within the class itself, it’s necessary to prefix the corresponding method or property name with `$this` which refers to this class.

#### Q. Explain multiple inheritance.

Multiple inheritance is a feature of some object-oriented computer programming languages in which an object or class can inherit characteristics and features from more than one parent object or parent class.

#### Q. Does PHP support multiple inheritance?

No. PHP only supports multi-level inheritance.

#### Q. Explain multi-level inheritance.

When a class is derived from a class which is also derived from another class, i.e. a class having more than one parent classes, such inheritance is called Multilevel Inheritance. The level of inheritance can be extended to any number of level depending upon the relation.

#### Q. What is polymorphism?

The Greek word Poly means “many” and morph means property which help us to assign more than one property with a single name.
1. Method overloading 
2. Method overriding
These are the example of polymorphism.

#### Q. What is method overloading?

Method overloading is the phenomenon of using same method name with different signature.

#### Q. Does PHP support method overloading?

PHP doesn’t support method overloading concept.

#### Q. What is method overriding?

Method definitions in child classes override definitions with the same name in parent classes. In a child class, we can modify the definition of a function inherited from parent class.

#### Q. What are interfaces in PHP?

Interfaces are defined to provide a common function names to the implementors. Different implementors can implement those interfaces according to their requirements. You can say, interfaces are skeltons which are implemented by developers.

#### Q. What does the presence of operator ‘::’ represent?

The scope resolution operator :: allows any declaration/definition of methods, variables outside the body of a class. 

#### Q. How to define a class in PHP?

Class always start with `class` keyword. After this write class name without parentheses.

```php
class demo{
    function add() {   
        $x = 800;
        $y = 200;
        $sum = $x + $y;
        echo "sum of given no= ". $sum . "<br/>";	
    }
    function sub() {
        $x = 1000;
        $y = 200;
        $sub = $x - $y;
        echo "Sub of given no = " . $sub;	
    }
}
```


#### Q. How will you add a constructor function to a PHP class?

PHP provides a special function called __construct() to define a constructor. You can pass as many as arguments you like into the constructor function.

#### Q. How will you add a destructor function to a PHP class?

Like a constructor function you can define a destructor function using function __destruct(). You can release all the resourceses with-in a destructor.

#### Q. How will you access the reference to same object within the object in PHP?

The variable $this is a special variable and it refers to the same object ie. itself.

#### Q. What do you mean by access modifier?

Access Modifier allows you to alter the visibility of any class member(properties and method).
In php, there are three scopes for class members.
1. Public
2. Protected
3. Private

#### Q. Explain access modifiers in PHP.

1. Public access modifier is open to use and access inside the class definition as well as outside the class definition.

2. Protected is only accessible within the class in which it is defined and its parent or inherited classes.

3. Private is only accessible within the class that defines it.( it can’t be access outside the class means in inherited class).

#### Q. Explain final class in PHP.

The final keyword prevents child classes from overriding a method by prefixing the definition with final.

It means if we define a method with final then it prevent us to override the method.

#### Q. Explain abstract class.

There must be a `abstract` keyword that must be return before this class for it to be abstract class to implement Abstraction.

This class cannot be instantiated. only the class that implement the methods of abstract class can be instantiated.

There can be more than one methods that can left undefined.

#### Q. What is interface?

The class that is fully abstract is called interface.

Any class that implement this interface must use implements keyword and all the methods that are declared in the class must be defined here. otherwise this class also need to be defined as abstract.


#### Q. What do you mean by an exception?

An exception is a problem that arised during the execution of a program. When an Exception occurs the normal flow of the program is disrupted and the program or application terminates abnormally.

#### Q. Define Exception class Hierarchy.

Throwable
 -- Error
   -- Arithmetic Error
   -- Parse Error
 -- Exception
   -- Logic Exception
   -- Runtime Exception


#### Q. How do we handle exceptions?

When an exception is thrown, code following the statement will not be executed, and PHP will attempt to find the first matching catch block. If an exception is not caught, a PHP Fatal Error will be issued with an "Uncaught Exception".
An exception can be thrown, and caught within PHP. 

To handle exceptions, code may be surrounded in a try block.
Each try must have at least one corresponding catch block. Multiple catch blocks can be used to catch different classes of exceptions.
Exceptions can be thrown (or re-thrown) within a catch block.

Consider:

```php
try {
    print "this is our try block n";
    throw new Exception();
} catch (Exception $e) {
    print "something went wrong, caught yah! n";
} finally {
    print "this part is always executed n";
}
```

#### Q. Differentiate between exception and error.

- Recovering from Error is not possible. The only solution to errors is to terminate the execution. Where as you can recover from Exception by using either try-catch blocks or throwing exception back to caller.
- You will not be able to handle the Errors using try-catch blocks. Even if you handle them using try-catch blocks, your application will not recover if they happen. On the other hand, Exceptions can be handled using try-catch blocks and can make program flow normal if they happen.
- Exceptions are related to application where as Errors are related to environment in which application is running.


#### Q. What do we mean by error log?

By default, PHP sends an error log to the server's logging system or a file, depending on how the `error_log` configuration is set in the php.ini file. By using the error_log() function you can send error logs to a specified file or a remote destination.


#### Q. How do we see PHP errors?

Display errors could be turned off in the php.ini or your Apache config file. You can turn it on in the script: `error_reporting(E_ALL);` `ini_set('display_errors', 1);` You should see the same messages in the PHP error log.


#### Q. What are the exception class functions?

There are following functions which can be used from Exception class.
`getMessage()` − message of exception
`getCode()` − code of exception
`getFile()` − source filename
`getLine()` − source line
`getTrace()` − n array of the `backtrace()`
`getTraceAsString()` − formated string of trace

#### Q. What does the expression `Exception::__toString` means?

`Exception::__toString` gives the string representation of the exception.


#### Q. Why do we need cryptography?

- Cryptography can be used for non-technological reasons like hiding physical messages, or creating ciphers so that only you and your friends can read your messages, but nowadays it is used for more vital reasons. It is the basis for Data Encryption. 
- Cryptography is used to make sure all of the things that I listed above shouldn't happen. I say shouldn't because nothing is perfect, and people can usually find loops holes or ways around the rules. Cryptography takes math and uses it to develop algorithms for computer systems to use to secure data either before data transfer or just for secure data storage.

#### Q. What do we mean by hash functions?

A hash function is any function that can be used to map data of arbitrary size to data of a fixed size. The values returned by a hash function are called hash values, hash codes, digests, or simply hashes.

#### Q. Whart is hash function in PHP?

It generates a hash value (message digest).

Syntax:

```php
string hash ( string $algo , string $data [, bool $raw_output = FALSE ] )
```

#### Q. Example using hash().

```php
echo hash('ripemd160', 'The quick brown fox jumped over the lazy dog.');
```
Output:
```
ec457d0a974c48d5685a7efa03d137dc8bbde7e3
```

#### Q. What is encoding and decoding?

Encoding means converting the message or information into a coded form in order to avoid hacking.

Decoding means converting signals into a different or usable form. The reverse process of encoding is known as decoding.

#### Q. What is SHA1?

In cryptography, SHA-1, Secure Hash Algorithm-1 is a cryptographic hash function which takes an input and produces a 160-bit hash value known as a message digest – typically rendered as a hexadecimal number, 40 digits long.

The sha1() function uses the US Secure Hash Algorithm 1.

Example:

```php
$str = "Hello";
echo sha1($str);
```

Output:

```
f7ff9e8b7bb2e09b70935a5d785e0cc5d9d0abf0
```

#### Q. Can sha1 be decrypted?

We cannot say that it is impossible at all (only in our world with limited resources it is). If you have a simple SHA1 hash, you could decrypt it if you guess what has been encrypted. But this is of course not efficient. In reality decrypting a large SHA-1 hash is nearly impossible.

#### Q. What is sha1_file()?

The sha1_file() function calculates the SHA-1 hash of a file.
This function returns the calculated SHA-1 hash on success, or FALSE on failure.

```php
$filename = "test.txt";
$sha1file = sha1_file($filename);
echo $sha1file;
```

Output:
```
aaf4c61ddcc5e8a2dabede0f3b482cd9aea9434d
```

#### Q. What are the disadvantages of sha1()?

Google announced the first SHA1 collision in 2017.
This requires a lot of computing power and resources. Since this never occurred naturally in real world under normal conditions we can rule out security risks today but not tomorrow.

SHA-1 for hashing passwords requires less computing power and this improves the performance of your application. Git still using SHA-1 for internal operations.

#### Q. What MD5 means?

MD5 (technically called MD5 Message-Digest Algorithm) is a cryptographic hash function whose main purpose is to verify that a file has been unaltered.

The md5() function calculates the MD5 hash of a string.
The md5() function uses the RSA Data Security, Inc. MD5 Message-Digest Algorithm.

```php
$str = "Hello";
echo md5($str);
```

Output:
```
8b1a9953c4611296a827abf8c47804d7
```

#### Q. Why can not a MD5 hash be decrypted?

There are no services which allow you to "decrypt MD5" because, MD5 is not an encryption algorithm. Hash functions take an input and create an output which cannot be turned back into the input. Because its not encrypted. MD5 is a hashing algorithm.

#### Q. Is md5 reversible?

Now a days MD5 hashes or any other hashes for that matter are pre computed for all possible strings and stored for easy access. Though in theory MD5 is not reversible but using such databases you may find out which text resulted in a particular hash value. f(x) = 1 is irreversible. Hash functions aren't irreversible.

#### Q. Compare sha1() and md5().

MD5 and SHA-1 have a lot in common; SHA-1 was clearly inspired on either MD5 or MD4, or both (SHA-1 is a patched version of SHA-0, which was published in 1993, while MD5 was described as a RFC in 1992).

The main structural differences are the following:

- SHA-1 has a larger state: 160 bits vs 128 bits.
- SHA-1 has more rounds: 80 vs 64.
- SHA-1 rounds have an extra bit rotation and the mixing of state words is slightly different (mostly to account for the fifth word).
- Bitwise combination functions and round constants are different.
- Bit rotation counts in SHA-1 are the same for all rounds, while in MD5 each round has its own rotation count.
- The message words are pre-processed in SHA-0 and SHA-1. In MD5, each round uses one of the 16 message words "as is"; in SHA-0, the 16 message words are expanded into 80 derived words with a sort of word-wise linear feedback shift register. SHA-1 furthermore adds a bit rotation to these word derivation.

#### Q. What is enctype?

The enctype attribute specifies how the form-data should be encoded when submitting it to the server. The enctype attribute can be used only if `method="post"`

Following are different types of enctype.

- `application/x-www-form-urlencoded` is the default value if the enctype attribute is not specified. This is the correct option for the majority of simple HTML forms.

- `multipart/form-data` is necessary if your users are required to upload a file through the form.

- `text/plain` is a valid option, although it sends the data without any encoding at all. It is not recommended, as its behavior is difficult to predict.


#### Q. Explain each Mcrypt function supported in PHP.

Mcrypt() supports many functions:

- Mcrypt_cbc()- Encrypts data in Cipher block chain mode.
- Mcrypt_cfb()- Encrypts data cipher feedback (CFB) mode
- Mcrypt_decrypt()- Decrypts data.
- mcrypt_encrypt- Encrypts plaintext with given parameters
- mcrypt_generic- Encrypts data
- mcrypt_get_key_size - Get the key size of the specified cipher
- mdecrypt_generic – Decrypts data

#### Q. What is cryptography authentication?

In cryptography, a message authentication code (MAC), sometimes known as a tag, is a short piece of information used to authenticate a message—in other words, to confirm that the message came from the stated sender (its authenticity) and has not been changed.

#### Q. What is HTML?

Hypertext Markup Language (HTML) is the standard markup language for creating web pages and web applications.

```html
<HTML>
   <HEAD>
      <TITLE>Your Title Here</TITLE>
   </HEAD>
   <BODY BGCOLOR="FFFFFF">
      contents of page
   </BODY>
</HTML>
```

#### Q. Differentiate between PHP and HTML.

- PHP is like the machinery behind a dynamic website whereas HTML is the structure and backbone of a website.
- HTML isn’t a programming language; it is a markup language that is used to create the structure of a webpage. PHP however is a full-blown programming language that is used to create most of the advanced functionality you see on modern webpages.

#### Q. What are the different methods or HTTP verbs of sending data to the server?

| HTTP Verb      | Use           |
| ------------- |-------------|
| GET      | used to request data from a specified resource |
| POST     | used to send data to a server to create/update a resource   |
| PUT     | used to send data to a server to create/update a resource   |
| HEAD     | almost identical to GET, but without the response body   |
| OPTIONS     | describes the communication options for the target resource   |
| DELETE     | deletes the specified resource   |

#### Q. What's the difference between GET and POST methods.

- For GET, parameters remain in browser history because they are part of the URL. POST parameters are not saved in browser history.
- GET data can be bookmarked.	In POST method, data can not be bookmarked.
- GET requests are re-executed but may not be re-submitted to server if the HTML is stored in the browser cache.	In POST method, the browser usually alerts the user that data will need to be re-submitted.
- Encoding type (enctype attribute)	application/x-www-form-urlencoded	multipart/form-data or application/x-www-form-urlencoded Use multipart encoding for binary data.
- Parameters	can send but the parameter data is limited to what we can stuff into the request line (URL). Safest to use less than 2K of parameters, some servers handle up to 64K	Can send parameters, including uploading files, to the server.
- GET data is easier to hack for script kiddies but POST data is more difficult to hack
- For GET, only ASCII characters are allowed.	No restrictions for POST. Binary data is also allowed.
Security	GET is less secure compared to POST because data sent 8.GET data is saved in browser history and server logs in plaintext.	POST is a little safer than GET because the parameters are not stored in browser history or in web server logs.
- Since form data is in the URL(for GET) and URL length is restricted. A safe URL length limit is often 2048 characters but varies by browser and web server.	No restrictions for POST method.
- GET method should not be used when sending passwords or other sensitive information.	POST method used when sending passwords or other sensitive information.
- GET method is visible to everyone (it will be displayed in the browser's address bar) and has limits on the amount of information to send. POST method variables are not displayed in the URL.
- GET can be cached whereas POST is not cached.


#### Q. How can we send email?

The mail() function is used to send emails in PHP. Inside mail() function you can pass three basic and one optional parameters.
 
1. Three Basic Parameters : The email address to send(Receiver email), Subject of mail, Content/message of the mail.

2. Optional Parameters: additional headers you want to include(headers and sender mail)

```php
extract($_POST);
if (isset($sendmail)) {
	
    $subject = "Mail Function in PHP";
	$from = "info@bootsity.com";
	$message = $name. " " . $mobile . " " . $query;
    $headers = "From: ".$from;
    mail($email, $subject, $message, $headers);
  
	echo "<h3 align='center'>Mail Sent Successfully</h3>";
}	
 
```

HTML Form:


```html
<!doctype html>
<html>
<head>
	<title>Mail function in php - Bootsity</title>
</head>
<body>
<form method="post">
 <table align="center" border="1">
	<tr>
	  <th>Enter Your name</th>
	  <td><input type="text" name="name"/></td>
	</tr>
	<tr>
	  <th>Enter Your mobile</th>
	  <td><input type="text" name="mobile"/></td>
	</tr>
	<tr>
	  <th>Enter Your email</th>
	  <td><input type="email" name="email"/></td>
	</tr>
	<tr>
	  <th>Enter Your Query</th>
	  <td><textarea name="query"></textarea></td>
	</tr>
	<tr>
	  <td align="center" colspan="2">
	  <input type="submit" value="Send Mail" name="sendmail"/>
	</tr>
	</table>	
</form>
</body>
</html>
```

#### Q. How file upload works?

First, we define FORM method as POST and enctype='multipart/form-data' both property must be defined for uploading a file.


```html
<html>
   <body>
	<form action="upload.php" enctype="multipart/form-data" method="post">
	  Your File Name <input type="file" name="file"/><br/>
	  <input type="submit" value="Upload" name="upload"/>
	</form>
   </body>
  </html>
```

The enctype attribute of the <form> tag specifies which content-type to use when submitting the form.

'multipart/form-data' is used when a form requires binary data, like the contents of a file, to be uploaded.

The type='file' attribute of the <input> tag specifies that the input should be processed as a file.

For example, when viewed in a browser, there will be a browse-button next to the input field.

Below is the code for upload.php

```php
if ($_POST['upload']) {
    move_uploaded_file(
        $_FILES["file"]["tmp_name"],
        "upload/" . $_FILES["file"]["name"]
    );  

    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Stored in: " . $_FILES["file"]["tmp_name"];
}
```
#### Q. What is SQL?

SQL stands for Structured Query Language. SQL is a standardized query language for requesting information from different databases

#### Q. Why do we need SQL with PHP?

In web applications, we need to store data. This data may relate to user, his activity, transaction and others. Modern applications store this data in RDBMS like MySQL or Oracle. To manage the data in these systems, we need SQL. Consider example of storing some user information in database:

```php
$data = "INSERT INTO users(firstname, lastname, email)
VALUES ('Maya', 'Sharma', 'maya@bootsity.com')";`
```


#### Q. How many types of database connections possible in PHP.

- MySQLi (object-oriented)
- MySQLi (procedural)
- PDO

#### Q. Adavantages of PDO over MySQLi approach.

1. Object Oriented
2. Bind parameters in statements (security)
3. Allows for prepared statements and rollback functionality (consistency)
4. Throws catcheable exceptions for better error handling (quality)
5. One API for a multiple of RDBMS brands

#### Q. How connect to the database using PDO?

```php
$servername = "localhost";
$username = "username";
$password = "password";

try {
        $conn = new PDO("mysql:host=$servername", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE myDBPDO";
        // use exec() because no results are returned
        $conn->exec($sql);
        echo "Database created successfully<br>";
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
```

#### Q. What is SQL injection?

SQL injection is a code injection technique that might destroy your database.
It usually occurs when you ask a user for input, like their username/userid, and instead of a name/id, the user gives you an SQL statement that you will unknowingly run on your database.

Consider: 

`SELECT * FROM Users WHERE UserId = 105 OR 1=1;`

The SQL above is valid and will return ALL rows from the "Users" table, since OR 1=1 is always TRUE.
A hacker might get access to all the user names and passwords in a database, by simply inserting 105 OR 1=1 into the input field.
Does the example above look dangerous? What if the "Users" table contains names and passwords?


#### Q. How can we get the browser's details using PHP?

One of the environment variables set by PHP is `HTTP_USER_AGENT` which identifies the user's browser and operating system.

#### Q. What is the use of Xdebug extension?

Xdebug. It uses the DBGp debugging protocol for debugging. It is highly configurable and adaptable to a variety of situations.

Xdebug provides following details in the debug information:

- Stack and function trace in the error messages.
- Full parameter display for user defined functions.
- Displays function name, file name and line indications where the error occurs.
- Support for member functions.
- Memory allocation

It can also be used for:
- Profiling information for PHP scripts.
- Code coverage analysis.

#### Q. What is the purpose of php.ini file?

The PHP configuration file, php.ini, is the final and most immediate way to affect PHP's functionality. The php.ini file is read each time PHP is initialized.in other words, whenever httpd is restarted for the module version or with each script execution for the CGI version. If your change isn.t showing up, remember to stop and restart httpd. If it still isn.t showing up, use phpinfo() to check the path to php.ini.

#### Q. What is curl?

cURL is a library that lets you make HTTP requests in PHP.

```php
  $curl_handle=curl_init();
  curl_setopt($curl_handle, CURLOPT_URL, 'http://www.google.com');
  curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
  curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
  $buffer = curl_exec($curl_handle);
  curl_close($curl_handle);
  if (empty($buffer)) {
      print "Nothing returned from url.<p>";
  } else {
      print $buffer;
  }
```
Then run it via command line:

`php < myphp.php`

You ran myphp.php and executed those commands through the php interpreter and dumped a ton of messy html and javascript to screen.

#### Q. What is PDO in PHP?

PDO stands for PHP Data Object.

It is a set of PHP extensions that provide a core PDO class and database, specific drivers.
It provides a vendor-neutral, lightweight, data-access abstraction layer. Thus, no matter what database we use, the function to issue queries and fetch data will be same.
It focuses on data access abstraction rather than database abstraction.


#### Q. What is autoloading classes in PHP?

With autoloaders, PHP allows the last chance to load the class or interface before it fails with an error.

The `spl_autoload_register()` function in PHP can register any number of autoloaders, enable classes and interfaces to autoload even if they are undefined.

```php
spl_autoload_register(function ($classname) {
    include  $classname . '.php';
});
$object  = new Class1();
$object2 = new Class2(); 
```

In the above example we do not need to include Class1.php and Class2.php. The `spl_autoload_register()` function will automatically load Class1.php and Class2.php.

#### Q. Discuss die().

While writing your PHP program you should check all possible error condition before going ahead and take appropriate action when required.

```php
if (!file_exists("/tmp/test.txt")) {
    die("File not found");
} else {
    $file = fopen("/tmp/test.txt", "r");
    print "Opened file successfully";
}
```
This way you can write an efficient code. Using above technique you can stop your program whenever it errors out and display more meaningful and user friendly message.

#### Q. What are variable variable?

Consider:

```php
$World = "Foo";
$Hello = "World";
$a = "Hello";

$a; //Returns Hello
$$a; //Returns World
$$$a; //Returns Foo
```

#### Q. What are return type declarations?

Example:

```php
function getTotal(float $a, float $b): float {
}
```

#### Q. Explain the Exception Hierarchy introduced in PHP 7?

New Hierarchy:

```
 |- Exception implements Throwable
       |- …
    |- Error implements Throwable
        |- TypeError extends Error
        |- ParseError extends Error
        |- ArithmeticError extends Error
            |- DivisionByZeroError extends ArithmeticError
        |- AssertionError extends Error
```        
      
#### Q. What is use of Spaceship Operator?
 
Return 0 if values on either side are equal
Return 1 if value on the left is greater
Return -1 if the value on the right is greater

Example:

```php
$compare = 2 <=> 1
2 < 1? return -1
2 = 1? return 0
2 > 1? return 1
```

#### Q. What is use of Null Coalesce Operator?

Null coalescing operator returns its first operand if it exists and is not NULL Otherwise it returns its second operand.

Example:

```php
$name = $firstName ?? $username ?? $placeholder ?? "Guest"; 
```
#### Q. What is an autoloader and what does it do?
#### Q. Name 2 ways to sort an array and explain what they do. For example, `sort()` arranges array elements from lowest to highest.
#### Q. What’s the difference between functions `include()` and `require()`?
#### Q. What are the `__construct()` and `__destruct()` methods in a PHP class?
#### Q. How can you determine the number of items in an array?
#### Q. What are two advantages of using namespaces?
#### Q. What are the 3 scope levels available in PHP and how would you define them?
#### Q. What are getters and setters and why are they important?
#### Q. Explain the difference between `===` and `==`.
#### Q. What is meant by dependency injection?
#### Q. Name 3 ways to protect against SQL injection?
#### Q. What is the difference between $_GET and $_POST
#### Q. What are some magic methods in PHP? How might they be used?
#### Q. Briefly explain one or both of the following design patterns:
	- Singleton
	- Factory
#### Q. What is cURL extention used for?
