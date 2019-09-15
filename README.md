## PHP Interview Questions 


#### Q. What is an autoloader and what does it do?
#### Q. After the code below is run, what are the values of `$a` and `$b`?

	```php
	    $a = '5';
	    $b = &$a;
	    $b = "2$b";
	```
#### Q. Name 2 ways to sort an array and explain what they do. For example, `sort()` arranges array elements from lowest to highest.
#### Q. What’s the difference between functions `include()` and `require()`?
#### Q. What are the `__construct()` and `__destruct()` methods in a PHP class?
#### Q. How can you determine the number of items in an array?
#### Q. What are two advantages of using namespaces?
#### Q. What are the 3 scope levels available in PHP and how would you define them?
#### Q. What are getters and setters and why are they important?
#### Q. Explain the difference between `===` and `==`.
#### Q. What is meant by dependency injection?
#### Q. Looking at the code below, what will the function `getTemplateName()` return?

	```php
	class Template
	{
	    protected $template_name;

	    public function __construct()
	    {
		$this->template_name = 'innovation_card';
	    }

	    public static function getTemplateName()
	    {
		return $this->template_name;
	    }
	}
	```
#### Q. Name 3 ways to protect against SQL injection?
#### Q. What is the difference between $_GET and $_POST
#### Q. What are some magic methods in PHP? How might they be used?
#### Q. Briefly explain one or both of the following design patterns:
	- Singleton
	- Factory
#### Q. What is cURL extention used for?
#### Q. What is a Closure?
#### Q. Explain, line by line, what the following code does. Can it be improved? If so, how?

	```php
	function inline_tweet($content, $options)
	{
	    $url = get_url();
	    $content = trim($content);
	    $tweet = strlen($content) > 140 ? substr($content, 0, 140 - (strlen($url)) : $content;

	    return sprintf(
		'<span class="%1$s"><a href="https://twitter.com/intent/tweet?text=%2$s&url=%3$s&via=%4$s" target="_blank">%5$s</a></span>',
		$options['class'],
		urlencode($tweet),
		urlencode($url),
		'trendwatching',
		$content
	    );
	}
	```
#### Q. Write your name below this line, commit your changes and push your branch to the remote repository: