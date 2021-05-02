<?php
	$id = $_GET['id'];

	function dbConnect() {
		$dsn = 'mysql:host=localhost;dbname=apple_data;charset=utf8';
		$user='apple_user';
		$pass='kanato2710';


			try{
				$dbh = new PDO($dsn,$user,$pass,[
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_EMULATE_PREPARES => false,
				]);
		
			} catch(PDOException $e){
				echo '接続失敗'. $e->getMessage();
				exit();
			};

			return $dbh;  
		}



	
	$dbh = dbConnect();

	//SQL準備
	$stmt = $dbh->prepare('SELECT * FROM user where id = :id');
	$stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
	//SQLを実行
	$stmt->execute();
	//結果を取得
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	

?>

<!DOCTYPE html>
<html>

<head>
	<title>英単語</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
	<div id="container">
		<div id="top_container">
			<p id="popTitle">メニュー</p>
		</div>

		<div class="page">
            <p class="user_name">ようこそ　<?php echo $result['name']?> さん</p>
			<div id="home">
				<div class="list">
					<button type="button" onclick="nextlesson()">レッスン</button>
					<button type="button" value="テスト" onclick="nexttest()">テスト</button>
					<button type="button" value="記録" onclick="skip(./記録/記録ホーム.html)">記録</button>
					<button type="button" value="苦手単語" onclick="skip(./記録/記録ホーム.html)">苦手単語</button>
					<button type="button" value="ログアウト" onclick="logout()">ログアウト</button>
				</div>
			</div>
		</div>
	</div>
</body>

<script type="text/javascript">
	let urlID = location.search;
		console.log(urlID); 

	function nextlesson(){
		let url = "./lesson/choose_lesson.html" + urlID;
		location.href = url;
	}

	function nexttest(){
		let url = "./test/test_home.php" + urlID;
		location.href = url;
	}

	function logout() {
		location.href = "logout.php";
	}

</script>
</html>