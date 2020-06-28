<?php include('connection.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title> Add Image </title>
</head>
<body>
	<form method="POST" action="adding.php"
	enctype="multipart/form-data">

	Name: <input type="text" name="name" required=""><br>
	Add File: <input type="file" name="img" required=""><br>
	<input type="submit" name="adding">

	</form>
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Image</th>
			</tr>	
		</thead>
		<tbody>
			<?php
			$display=mysqli_query($con, "SELECT * FROM img");
			while($fetch=mysqli_fetch_array($display))
			{
				?>
				<tr>
					<td><?php echo $fetch['id']; ?></td>
					<td><?php echo $fetch['name']; ?></td>
					<td><img src="<?php echo $fetch['image'] ?>" style ="width: 100px; height: 100px"></td>
					</tr>
				<?php } ?>
		</tbody>
	</table>
</body>
</html>
<?php
	if (isset($_POST['adding']))
	{
		$name = $_POST['name'];
		$imgtmp=$_FILES['img']['tmp_name'];
		$imgname=$_FILES['img']['name'];
		$imgtype=$_FILES['img']['type'];
		$filetransferto="images/$imgname";
		move_uploaded_file($imgtmp,$filetransferto);

		$adding = mysqli_query ($con, "INSERT into img (name,image) VALUES ('$name','$filetransferto')");

		if ($adding)
		{
			echo ("Image Transfered and Inserted");
		}
	}



	?>




