<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Notification</title>
      <link rel="stylesheet" href="bootstrap.css">
      <link rel="stylesheet" href="style2.css">
      <style>
      body {
			font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            min-height: 100vh;
                 
		}
         img{
		   width: 20px;
		   height: 20px;
		   border-radius: 30px;
	   }   



		input[type=submit],
		input[type=button] {
			background-color: purple;
			color: white;
			padding: 12px 12px;
			border: none;
			/* border-radius: 10px; */
			cursor: pointer;
		}

		/*input[type=submit]:hover,*/
        /*{*/
		/*	background-color: #525252;*/
		/*}*/
        .header2 button:hover{
            background-color: #525252;
        }

		.header2 select:hover {
			background-color: #525252;
		}

        .header2 button{
            height:35px;
            width:150px;
            text-align:center;
            background-color: #203169;
            color:white;
        }

		.header2 select {
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
			margin-top: 6px;
			margin-bottom: 16px;
			resize: vertical;
            height:35px;
            width:150px;
            text-align:center;
            background-color: #203169;
            color:white;
		}
		table {
			table-layout: fixed;
		}

		td {
			word-wrap: break-word;
			padding-left: 10px;
		}

        .container1{
          position: absolute;
          right: 0;
          width: 100%;
          min-height: 100vh;
          background: linear-gradient(mediumpurple, white);
        }
	</style>
	<script src="Javascipt_File.js">
  </script>
</head>
<body style="background-color: red;">
<div class="container1">
      <div class="header2" style="background-color:lightblue;">
            <div class="nav">
            <div><h1 style="color: black; padding-left:600px; padding-top:20px;"><p id="Topic1">Notifications</p></></div>
            
		
		<table>
			
			<tbody>
				<tr >
				<form action="">
				<td>
				<div class="input-group mb-3" style="  width: 50%;padding-right:50px;padding-left:170px;">
				<td style="padding-left: 0px;">    <button class="btn btn-outline-light" type="submit" id="button-addon1" style="height: 35px; width:100px; border-bottom-left-radius: 5px; border-top-left-radius: 5px; background-color: #0a58ca;">Search</button></td>
				<td style="padding-left: 0px;">   <input type="text" class="form-control" placeholder="Enter ID Number........." aria-label="Example text with button addon" aria-describedby="button-addon1" style="height: 35px;border-bottom-right-radius: 5px; border-top-right-radius: 5px;" ></td>
		
				</div>
				</td>
				</form>
				
					<form action="">
				 	<td style="padding-top: 10px; padding-left:150px;">
						<div >
			
							<select class="form-select" aria-label="Default select example">
								<option selected>Latest</option>
								<option value="1">Oldest</option>
								
							</select>
						</div>
					</td>
					<td style="padding-left:20px;">
						<div >
							<button type="submit" class="btn btn-success">Apply Filter</button>
						</div>
					</td>
					</form>   
				</tr>
			</tbody>
			
		</table>
		
		
      </div >
		<div style="padding-top: 50px;">
		<a class="btn btn-outline-light" href="applicant_dashboard.php" role="button" style="height: 35px; width: 150px; background-color:#1cdb92; margin-top:30px; margin-right: 10px;">Back</a>
		</div>
                  
            </div>
      <div class="side_menu1" style="padding-top: 200px;padding-left:0px; background-color: lightblue;">
          <ul>
			     <li><input type="radio" name="h" class="btn-check" id="btn_check_outlinedT1" autocomplete="off" onclick="Notification1()" >
					<label class="btn btn-outline-primary" for="btn_check_outlinedT1"><p style="font-weight: bold;width:100px; height:25px; text-align: center;" >Appoinment Time</p></label><br>
				</li>
			
			<br>
			<li>
			<input type="radio" name="h" class="btn-check" id="btn_check_outlinedR1" autocomplete="off" onclick="Notification1()">
			<label class="btn btn-outline-primary" for="btn_check_outlinedR1"><p style="font-weight: bold; width:100px; height:25px; text-align: center;" >Reject Application</p></label>
			</li><br>
		
				<li><input type="radio" name="h" class="btn-check" id="btn_check_outlinedS1" autocomplete="off" onclick="Notification1()">
					<label class="btn btn-outline-primary" for="btn_check_outlinedS1"><p style="font-weight:bold; width:100px; height:25px; text-align: center;" >Sent Messages</p></label>
				</li>
			
      </ul>
          
	</div>
     
     
      <div class="Center">
	
	<fieldset id="Time1" style="display: block;"> 
	<div>
      <table class="table table-primary table-hover" >
        
	<thead>
	<tr>
		
		<th scope="col">Autherize officer</th>
            <th scope="col">Appoinment Date</th>
		<th scope="col">Appointment Time</th>
		<th scope="col">Confirm</th>
            <th scope="col">Ask another date</th>
	</tr>
	</thead>
	<tbody>
	<tr>  
            <td>name</td>
		<td>Mark</td>
		<td>Otto</td>
		<td><button type="submit" class="btn btn-outline-success">Confirm</button></td>
            <td><button type="button" class="btn btn-outline-success">Another Date</button></td>
	</tr>
	
	
	</tbody>
	</table>
      </div>
	</fieldset>
	
	
	
	<fieldset id="Reject_message1" style="display: none;">
	<div>
      <table class="table table-primary table-hover" >
        
	<thead>
	<tr>
		
		<th scope="col">Autherize officer</th>
		<th scope="col">Received Date</th>
		<th scope="col">View Message</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		
		<td>Mark</td>
		<td>Otto</td>
		<td><a href="view_message.php"><button type="button" class="btn btn-outline-primary" style="width: 100px;"><img src="Image/view.png" > view</button></a></td>
	</tr>
	</tbody>
	</table>
      </div>	
	</fieldset>

      <fieldset  id="Sent_message1" style="display:none;">
	<div>
      <table class="table table-primary table-hover" >
        
	<thead>
	<tr>
		<th scope="col">Autherize officer</th>
		<th scope="col">Appointment Date</th>
		<th scope="col">Appointment Time</th>
		<th scope="col">Send Date</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<th scope="row">1</th>
		<td>Mark</td>
		<td>Otto</td>
		<td>@mdo</td>
	</tr>
	<tr>
		<th scope="row">2</th>
		<td>Jacob</td>
		<td>Thornton</td>
		<td>@fat</td>
	</tr>
	
	</tbody>
	</table>
      </div>
	</fieldset>
</div></div>

</body>
</html>