<?php 
	session_start();

	if (isset($_SESSION['UserID']) && isset($_SESSION['Username'])) {

 	?>
	<a href="logout.php" class="logout">
		<i class='bx bxs-log-out-circle' ></i>
		<span class="text">Logout</span>
	</a>

    <a href="logout.php">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout</a>
	<?php 
		}else{
     	header("Location: index.php");
     	exit();
	}
?>
	
			
