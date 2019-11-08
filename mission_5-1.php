<html>
<head>
  <meta charset="UTF-8">
<h1>動くか</h1>
<title></title>
</head>
<body>

<?php
$dsn = "データベース名";
$user = "ユーザー名";
$password = "パスワード";
$date = date('Y/m/d H:i:s');
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

if (empty($_POST["khb"]) && !empty($_POST["name"]) && !empty($_POST["comment"]) && !empty($_POST["pass"])){
	$name = $_POST["name"]   ;
        $comment = $_POST["comment"];
	$pass = $_POST["pass"];
        $sql = $pdo -> prepare("INSERT INTO tbk (name, comment, date, pass) VALUES (:name, :comment, :date, :pass)");
	$sql -> bindParam(':name', $name, PDO::PARAM_STR);
	$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
	$sql -> bindParam(':date', $date, PDO::PARAM_STR);
	$sql -> bindParam(':pass', $pass, PDO::PARAM_STR);
	$sql -> execute();
}
if (!empty($_POST["dn"]) && !empty($_POST["dpass"])) {		//削除機能、
	$dn = $_POST["dn"];
	$dpass = $_POST["dpass"];
$sql = 'SELECT * FROM tbk';
	$stmt = $pdo->query($sql);
	$dresult = $stmt->fetchAll();
	foreach ($dresult as $row1){
if ($row1['id'] === $dn && $row1['pass'] === $dpass){
$sql = 'delete from tbk where id=:id and pass=:pass';
$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':id', $dn, PDO::PARAM_INT);
	$stmt->bindParam(':pass', $dpass, PDO::PARAM_INT);
	$stmt->execute();
} 
elseif ($row1['id'] == $dn && $row1['pass'] != $dpass){
echo "パスワードが違います";
}
}}

if(!empty($_POST["hn"]) && !empty($_POST["hpass"])){		//編集選択
	$hn = $_POST["hn"];
	$hpass = $_POST["hpass"];
	$sql = 'SELECT * FROM tbk';
	$stmt = $pdo->query($sql);
	$result = $stmt->fetchAll();
	foreach ($result as $row2){

if ($row2['id'] === $hn && $row2['pass'] === $hpass){
	$hmnum = $row2['id'];
	$hmname = $row2['name'];
	$hmcomment = $row2['comment'];
}
elseif($row2['id'] == $hn && $row2['pass'] != $hpass) {
echo "パスワードが違います";

}}
}

//編集機能
if (!empty($_POST["khb"]) && !empty($_POST["name"]) && !empty($_POST["comment"]) && !empty($_POST["pass"])){
	$khb = $_POST["khb"];
	$hname = $_POST["name"];
	$hcomment = $_POST["comment"];
	$hpass = $_POST["pass"];
	$hdate = date('Y/m/d H:i:s');
$sql = 'SELECT * FROM tbk';
	$stmt = $pdo->query($sql);
	$sresult = $stmt->fetchAll();
	foreach ($sresult as $row3){
if($row3['id'] == $khb){
$sql = 'update tbk set name=:name,comment=:comment,date=:date,pass=:pass where id=:id ';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':name', $hname, PDO::PARAM_STR);
	$stmt->bindParam(':comment', $hcomment, PDO::PARAM_STR);
	$stmt->bindParam(':id', $khb, PDO::PARAM_INT);
	$stmt->bindParam(':date', $hdate, PDO::PARAM_STR);
	$stmt->bindParam(':pass', $hpass, PDO::PARAM_STR);
	$stmt->execute();
} else {
}
}}
?>
</br>
  <form method ="POST" action="mission_5-1.php">
<p>【投稿フォーム】</p>
<p><input type="text" name="name" placeholder="名前" value= "<?php if(!empty($hmname)){ echo $hmname ;} else {} ?>"></p>

<p><input type="text" name="comment" placeholder="コメント" value= "<?php if(!empty($hmcomment)){ echo $hmcomment ;} else {} ?>" ></p>
<p>
<input type="password" name="pass" placeholder="パスワード(任意)">
<input type="submit" value="送信"></p>

<p><input type="hidden" name="khb" value= "<?php if(!empty($hmnum)){ echo $hmnum ;} else {} ?>" ></p>

</form>
</br>
<form method="POST"action="mission_5-1.php">
<p>【削除フォーム】</p>
<p><input type="text" name="dn" placeholder="削除対象番号"></p>
<p><input type="text" name="dpass" placeholder="パスワード">
<input type="submit"  value="削除"></p>
</form>
</br>
<form method="POST" action="mission_5-1.php">
<p>【編集フォーム】</p>
<p><input type="text" name="hn" placeholder="編集対象番号"></p>
<p><input type="text" name="hpass" placeholder="パスワード">
<input type="submit" value="編集"></p>
</form>

<?php
	$sql = 'SELECT * FROM tbk';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		
		echo $row['id'].'　';
		echo $row['name'].'　';
		echo $row['comment'].'　';
		echo $row['date'].'　';
		echo '<br>';
	echo "<hr>";
}
?>
</body>
</html>