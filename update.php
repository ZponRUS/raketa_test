<?
	require 'db.php';
	$db = new DB;

	if(isset($_POST['fio'])){
		$emails = array();
		$phones = array(); //Простите меня за это, так получилоь, мне стыдно :( Но это работает!
		foreach ($_POST as $n => $key){
			if($n[0] == 'e' and $key != '') $emails[] = $key;
			if($n[0] == 't' and $key != '') $phones[] = array($key, $_POST['r'.$n[1]]);
		}
		$db->UpdateProfile($_GET['id'], $_POST['fio'], $emails, $phones);
		header('Location: /');
	}
	if(!isset($_GET['id'])) header('Location: /');
	$p = $db->GetProfile($_GET['id']);

	function w($s){
		if(!is_null($s)) return $s; else return '';
	}

	function c($s, $n){
		if($s == $n and !is_null($s)) return 'checked';
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Update Profile</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<form action="update.php?id=<?=$_GET['id']?>" method="POST">

  <div class="form-group">
    <label for="fio">Фио</label>
    <input type="text" class="form-control" id="fio" name="fio" value="<?=w($p[0])?>" placeholder="ФИО">
  </div>

  <div class="row">
    <div class="col">
      <label for="p">Email</label><br>
      <input type="text" class="form-control" id="p" name="e1" value="<?=@w($p[1][0])?>" placeholder="Почта (Основной)">
      <input type="text" class="form-control" id="p" name="e2" value="<?=@w($p[1][1])?>" placeholder="Почта #2">
      <input type="text" class="form-control" id="p" name="e3" value="<?=@w($p[1][2])?>" placeholder="Почта #3">
      <input type="text" class="form-control" id="p" name="e4" value="<?=@w($p[1][3])?>" placeholder="Почта #4">
      <input type="text" class="form-control" id="p" name="e5" value="<?=@w($p[1][4])?>" placeholder="Почта #5">
    </div>

    <div class="col">
      <label for="e">Телефоны</label><br>
      <input type="text" class="form-control" id="e" name="t1" value="<?=@w($p[2][0][0])?>" placeholder="Телефон (Основной)">
	  <div class="form-check form-check-inline">
	    <input class="form-check-input" type="radio" name="r1" id="r1" value="0" <?=@c($p[2][0][1], 0)?>>
	    <label class="form-check-label" for="r1">Домашний</label>
	  </div>
	  <div class="form-check form-check-inline">
	    <input class="form-check-input" type="radio" name="r1" id="r2" value="1" <?=@c($p[2][0][1], 1)?>>
	    <label class="form-check-label" for="r2">Мобильный</label>
	  </div>
	  <div class="form-check form-check-inline">
	    <input class="form-check-input" type="radio" name="r1" id="r3" value="2" <?=@c($p[2][0][1], 2)?>>
	    <label class="form-check-label" for="r3">Рабочий</label>
	  </div><br><br>  	  
    
      <input type="text" class="form-control" id="e" name="t2" value="<?=@w($p[2][1][0])?>" placeholder="Телефон #2">
	  <div class="form-check form-check-inline">
	    <input class="form-check-input" type="radio" name="r2" id="r12" value="0" <?=@c($p[2][1][1], 0)?>>
	    <label class="form-check-label" for="r12">Домашний</label>
	  </div>
	  <div class="form-check form-check-inline">
	    <input class="form-check-input" type="radio" name="r2" id="r22" value="1" <?=@c($p[2][1][1], 1)?>>
	    <label class="form-check-label" for="r22">Мобильный</label>
	  </div>
	  <div class="form-check form-check-inline">
	    <input class="form-check-input" type="radio" name="r2" id="r32" value="2" <?=@c($p[2][1][1], 2)?>>
	    <label class="form-check-label" for="r32">Рабочий</label>
	  </div><br><br> 

      <input type="text" class="form-control" id="e" name="t3" value="<?=@w($p[2][2][0])?>" placeholder="Телефон #3">
	  <div class="form-check form-check-inline">
	    <input class="form-check-input" type="radio" name="r3" id="r13" value="0" <?=@c($p[2][2][1], 0)?>>
	    <label class="form-check-label" for="r13">Домашний</label>
	  </div>
	  <div class="form-check form-check-inline">
	    <input class="form-check-input" type="radio" name="r3" id="r23" value="1" <?=@c($p[2][2][1], 1)?>>
	    <label class="form-check-label" for="r23">Мобильный</label>
	  </div>
	  <div class="form-check form-check-inline">
	    <input class="form-check-input" type="radio" name="r3" id="r33" value="2" <?=@c($p[2][2][1], 2)?>>
	    <label class="form-check-label" for="r33">Рабочий</label>
	  </div><br><br> 

      <input type="text" class="form-control" id="e" name="t4" value="<?=@w($p[2][3][0])?>" placeholder="Телефон #4">
	  <div class="form-check form-check-inline">
	    <input class="form-check-input" type="radio" name="r4" id="r14" value="0" <?=@c($p[2][3][1], 0)?>>
	    <label class="form-check-label" for="r14">Домашний</label>
	  </div>
	  <div class="form-check form-check-inline">
	    <input class="form-check-input" type="radio" name="r4" id="r24" value="1" <?=@c($p[2][3][1], 0)?>>
	    <label class="form-check-label" for="r24">Мобильный</label>
	  </div>
	  <div class="form-check form-check-inline">
	    <input class="form-check-input" type="radio" name="r4" id="r34" value="2" <?=@c($p[2][3][1], 0)?>>
	    <label class="form-check-label" for="r34">Рабочий</label>
	  </div><br><br> 

      <input type="text" class="form-control" id="e" name="t5" value="<?=@w($p[2][4][0])?>" placeholder="Телефон #5">
	  <div class="form-check form-check-inline">
	    <input class="form-check-input" type="radio" name="r5" id="r15" value="0" <?=@c($p[2][4][1], 0)?>>
	    <label class="form-check-label" for="r15">Домашний</label>
	  </div>
	  <div class="form-check form-check-inline">
	    <input class="form-check-input" type="radio" name="r5" id="r25" value="1" <?=@c($p[2][4][1], 0)?>>
	    <label class="form-check-label" for="r25">Мобильный</label>
	  </div>
	  <div class="form-check form-check-inline">
	    <input class="form-check-input" type="radio" name="r5" id="r35" value="2" <?=@c($p[2][4][1], 0)?>>
	    <label class="form-check-label" for="r35">Рабочий</label>
	  </div><br><br> 
	  	  	  	  
    </div>
    </div> 

  <center><button type="submit" class="btn btn-primary">Изменить</button></center>

</form>
</body>
</html>