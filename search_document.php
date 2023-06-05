<?php
	include("connection.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="search_style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Goldman">
	<style>
		table,th{
			border-collapse: collapse;
  			border:1px solid rgb(0,0,0);
		}
		table{
			width:80%;
	        padding:0px;
	        outline:0px;
	        margin-left:10%;
	        margin-right:10%;
	        margin-bottom:150px;
		}
		th{
	        color:rgb(180,180,180);
	        text-align:center;
	        padding:20px;
	        background-color:rgba(0,0,0,40%);
	        line-height:20px;
	    }
	    th:hover{
	        color:white;
	    }
	</style>
</head>
<body>
	<div id = "form">
		<div id = "form_topic"><h1>Document Searching</h1></div>
		<form name = "form" method = "POST">
			<label> ID: </label>
			<input type = "text" id = "doc_id" name = "doc_id" style="width: 175px"><br><br>
			<label> Name: </label>
			<input type = "text" id = "doc_name" name = "doc_name" style="width: 175px"><br><br>
			<label> Posted Date: </label>
			<input type = "text" id = "doc_pdate" name = "doc_pdate" style="width: 175px"><br><br>
			<label> Posted User: </label>
			<input type = "text" id = "doc_puser" name = "doc_puser" style="width: 175px"><br><br>
			<label> Safe Level: </label>
			<input type = "text" id = "doc_safe_level" name = "doc_safe_level" style="width: 175px;"><br><br>
			<label> Sort By: </label>
			<select id = "doc_sort_depends" name = "doc_sort_depends" style="width: 182px;  height: 20px">
				<option value="id asc">ID</option>
        		<option value="title asc">User</option>
        		<option value="post_date asc">Date</option>
        		<option value="sid asc">Site</option>
        		<option value="safe_level asc">Level</option>
        		<option value="likes asc">Liked</option>
				<option value="id desc">ID (desc)</option>
        		<option value="title desc">User (desc)</option>
        		<option value="post_date desc">Date (desc)</option>
        		<option value="sid desc">Site (desc)</option>
        		<option value="safe_level desc">Level (desc)</option>
        		<option value="likes desc">Liked (desc)</option>
			</select><br><br>
			<div align = "center">
			<input type = "submit" id = "btn_search" value = "Search" name = "submit" style="width:182px;height:40px; font-family: 'Goldman';">
			</div>
		</form>

	</div>
	<br><br><br>
	<table>
		<thead>
			<tr>
      			<th width="50px">ID</th>
      			<th width="150px">Name</th>
      			<th width="150px">Safe Level</th>
      			<th width="150px">Posted User</th>
      			<th width="150px">Posted Date</th>
      			<th width="150px">Placed Site</th>
      			<th width="50px">Like</th>
      			<th width="50px">Detail</th>
    		</tr>
		</thead>
		<tbody>
			<?php
				if(isset($_POST['submit'])){
					$doc_id = $_POST['doc_id'];
					$doc_name = $_POST['doc_name'];
					$doc_pdate = $_POST['doc_pdate'];
					$doc_puser = $_POST['doc_puser'];
					$doc_safe_level = $_POST['doc_safe_level'];
					$doc_sort_depends = $_POST['doc_sort_depends'];
					$doc_count = 0;
					$sql_cmd = "select id,title,safe_level,uid,post_date,sid,count(select * from liked_d where liked_d.did = document.id) as likes,content from document where ";
					if($doc_id != ""){
						$sql_cmd = $sql_cmd . "id = '$doc_id'";
					}
					if($doc_name != ""){
						$sql_cmd = $sql_cmd . " and title = '$doc_name'";
					}
					if($doc_pdate != ""){
						$sql_cmd = $sql_cmd . " and post_date = '$doc_pdate'";
					}
					if($doc_puser != ""){
						$sql_cmd = $sql_cmd . " and uid = '$doc_puser'";
					}
					if($doc_safe_level != ""){
						$sql_cmd = $sql_cmd . " and safe_level = '$doc_safe_level' ";
					}

					if($doc_sort_depends != ""){
						$sql_cmd = $sql_cmd . "order by $doc_id , id asc";
					}
					else{
						$sql_cmd = $sql_cmd . "order by id";
					}

					$result = mysqli_query($conn,$sql_cmd);

					if(mysqli_num_rows($result) > 0)
					{
						foreach($result as $row)
						{
					?>
					<tr>
						<th><?php echo $row['id']; ?></th> 
						<th><?php echo $row['title']; ?></th> 
						<th><?php echo $row['safe_level']; ?></th>
						<th><?php echo $row['uid']; ?></th> 
						<th><?php echo $row['post_date']; ?></th> 
						<th><?php echo $row['sid']; ?></th>
						<th><?php echo $row['likes']; ?></th> 
						<th><?php echo "<a href='";
								echo $row["content"];
								echo "'>click me</a>"; ?></th> 
					</tr>
					<?php
						}
					}
				}
			?>
		</tbody>
	</table>
	
</body>
</html>