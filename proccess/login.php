<?php
	include('../conn.php');
	session_start();
	function check_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$username = check_input($_POST['username']);

		if (!preg_match("/^[a-zA-Z0-9_]*$/",$username))
		{
			$_SESSION['msg'] = "Username should not contain space and special characters!"; 
			header('location: ../index.php');
		}
		else
		{
			$fusername=$username;
			$password = check_input($_POST["password"]);
			$fpassword=md5($password);
			
			$query=mysqli_query($conn,"select * from `user` where username='$fusername' and password='$fpassword'");
			// comenzar hacer la vaidaciones para madar con json.
			if(mysqli_num_rows($query)==0){
				$datos = array('error'=>true, 'message'=>'Login Failed, Check your data!');
				echo json_encode($datos);
			}
			else
			{
				$row=mysqli_fetch_array($query); // traemos los registros
				if($row != null)
				{
					$_SESSION['id']=$row['userid'];
					$datos = array('error'=>false, "user"=>$row['username'],'access'=>$row['access']); // guardamos en array los datos que 
					// datos que mandamos
					echo json_encode($datos);
				}
			}
		}
	}


	/* Codigo anterior abajo
		
	include('../conn.php');
	session_start();
	function check_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$username=check_input($_POST['username']);
		
		if (!preg_match("/^[a-zA-Z0-9_]*$/",$username)) {
			$_SESSION['msg'] = "Username should not contain space and special characters!"; 
			header('location: ../index.php');
		}
		else{
			
		$fusername=$username;
		
		$password = check_input($_POST["password"]);
		$fpassword=md5($password);
		
		$query=mysqli_query($conn,"select * from `user` where username='$fusername' and password='$fpassword'");
		
		if(mysqli_num_rows($query)==0){
			$_SESSION['msg'] = "Login Failed, Invalid Input!";
			header('location: ../index.php');
		}
		else{
			
			$row=mysqli_fetch_array($query);
			if ($row['access']==1){
				$_SESSION['id']=$row['userid'];
				?>
				<script>
					window.alert('Login Success, Welcome Admin!');
					window.location.href='../POS/admin/';
				</script>
				<?php
			}
			elseif ($row['access']==2){
				$_SESSION['id']=$row['userid'];
				?>
				<script>
					window.alert('Login Success, Welcome User!');
					window.location.href='../index.php';
				</script>
				<?php
			}
			else{
				$_SESSION['id']=$row['userid'];
				?>
				<script>
					window.alert('Login Success, Welcome Supplier!');
					window.location.href='../POS/supplier/';
				</script>
				<?php
			}
		}
		
		}
	}*/
?>