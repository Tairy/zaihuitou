<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>add</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<form action="#" method="post" accept-charset="utf-8">
		<input type="text" name="comment" value="" placeholder="comment"><br/>
		<input type="text" name="answer" value="" placeholder="answer"><br/>
		<button type="submit" name="submit">submit</button>
	</form>

	<?php
		$mongo = new MongoClient();
		$db = $mongo -> selectDB("airesponse");
		$collection = $db -> response;
		if(!empty($_POST['comment']) && !empty($_POST['answer'])){
			$collection -> insert(array("comment" => $_POST['comment'], "response" => $_POST['answer']));
		}
	?>
</body>
</html>