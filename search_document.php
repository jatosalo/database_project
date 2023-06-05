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
				<option value="by_id_asc">ID</option>
        		<option value="by_user_asc">User</option>
        		<option value="by_date_asc">Date</option>
        		<option value="by_site_asc">Site</option>
        		<option value="by_level_asc">Level</option>
        		<option value="by_liked_asc">Liked</option>
				<option value="by_id_desc">ID (desc)</option>
        		<option value="by_user_desc">User (desc)</option>
        		<option value="by_date_desc">Date (desc)</option>
        		<option value="by_site_desc">Site (desc)</option>
        		<option value="by_level_desc">Level (desc)</option>
        		<option value="by_liked_desc">Liked (desc)</option>
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
			<tr>
	    		<th>1</th>
      			<th>2</th>
      			<th>3</th>
      			<th>4</th>
      			<th>5</th>
      			<th>6</th>
      			<th>7</th>
      			<th>8</th>
			</tr>
		</tbody>
	</table>
	
</body>
</html>