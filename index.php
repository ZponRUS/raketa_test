<?
require 'db.php';
$db = new DB;
if(isset($_POST['id'])){
	$db->DeleteProfile($_POST['id']);
	exit();
}
$ids = $db->GetAllProfiles();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Profiles Manager</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="crossorigin="anonymous"></script>
</head>
<body>
	<center><a href="new.php"><button type="button" class="btn btn-success">Создать новую запись</button></a></center>
	<table class="table">
	  <thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">ФИО</th>
	      <th scope="col">Email(s)</th>
	      <th scope="col">Телефон(ы)</th>
	      <th scope="col">Изменить</th>
	      <th scope="col">Удалить</th>
	    </tr>
	  </thead>
	  <tbody
		<?
		$k = 1;
		foreach ($ids as $id) {
			$profile = $db->GetProfile($id);
			$emails = '';
			if(isset($profile[1][0])) $profile[1][0] .= ' (осн.)';
			foreach ($profile[1] as $email) {
				$emails .= $email."<br>";
			}

			$phones = '';
			if(isset($profile[2][0])) $profile[2][0][0] .= ' (осн.)';
			foreach ($profile[2] as $phone) {
				$phones .= $phone[0];
				switch ($phone[1]) {
					case 0:
						$phones .= ' (Дом.)';
						break;
					case 1:
						$phones .= ' (Моб.)';
						break;
					case 2:
						$phones .= ' (Раб.)';
						break;
				}				
				$phones .= '<br>';
			}			
	  
		print('
	    <tr>
	      <th scope="row">'.$k.'</th>
	      <td>'.$profile[0].'</td>
	      <td>'.$emails.'</td>
	      <td>'.$phones.'</td>
	      <td><a href="update.php?id='.$id.'"><button type="button" class="btn btn-info">Изменить</button></td></a>
	      <td><button type="button" onclick="deleteProfile('.$id.')" class="btn btn-danger">Удалить</button></td>
	    </tr>');
	    $k++;
		}
	   ?>
	  </tbody>
	</table>
	<script type="text/javascript">
		function deleteProfile(id){
			$.ajax({
				url: '/index.php',
				method: 'POST',				
				data: {id: id},
				success: function(){
					window.location.replace('/');
				}
			});
		}
	</script>
</body>
</html>