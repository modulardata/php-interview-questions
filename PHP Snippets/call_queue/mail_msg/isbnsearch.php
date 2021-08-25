<?php
	
	///api/books.xml?access_key=Z&index1=full&value1=221b+baker+street 
	$isbn=$_REQUEST['isbn'];
		$ch = curl_init();
		// Set URL to URL variable
		curl_setopt($ch, CURLOPT_URL,"http://isbndb.com/api/books.xml");
		// Set URL HTTP post to 1
		curl_setopt($ch, CURLOPT_POST, 1);
		// Set URL HTTP post field values
		curl_setopt($ch, CURLOPT_POSTFIELDS,
		"access_key=S5AEHY53&index1=isbn&value1=$isbn");
		// Set URL return value to True to return the transfer as a string
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// The URL session is executed and passed to the browser
		$curl_output =curl_exec($ch);
		print_r($curl_output);
		$Title = explode("<Title>", $curl_output);
		//print_r($pieces);
		$Title1 = explode("</Title>", $Title[1]);
		
		echo "<br><br><br>BOOK Title :- ".$booktitel=$Title1[0];
		
		
		$TitleLong1 = explode('<TitleLong', $curl_output);
		$TitleLong2 = explode('>', $TitleLong1[1]);
		//print_r($pieces);
		$TitleLong3 = explode("</TitleLong>", $TitleLong2[1]);
		
		echo "<br>TitleLong :- ".$TitleLong=$TitleLong3[0];
		
		
		
		$AuthorsText = explode("<AuthorsText>", $curl_output);
		//print_r($pieces);
		$AuthorsText1 = explode("</AuthorsText>", $AuthorsText[1]);
		
		
		echo "<br><br>AuthorsText :- ".$AuthorsTextname=$AuthorsText1[0];
	
	
		$PublisherText2 = explode('<PublisherText', $curl_output);
		$PublisherText2 = explode('>', $PublisherText2[1]);
		//print_r($pieces);
		$PublisherText1 = explode("</PublisherText>", $PublisherText2[1]);
		
		echo "<br>PublisherText :- ".$PublisherTextname=$PublisherText1[0];
		
		
		
?>
