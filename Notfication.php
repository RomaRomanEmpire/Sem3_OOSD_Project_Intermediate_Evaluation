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
           
            /* html{
                  height: 100%;
            } */
      body {
			font-family: Arial, Helvetica, sans-serif;
                 
			text-align: center;
                  min-height: 100vh;
                 
		}
            



		input[type=submit],
		input[type=button] {
			background-color: purple;
			color: white;
			padding: 12px 12px;
			border: none;
			border-radius: 10px;
			cursor: pointer;
		}

		input[type=submit]:hover {
			background-color: #525252;
		}

		select:hover {
			background-color: #494949;
		}

		select {
			width: 50%;
			padding: 12px;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
			margin-top: 6px;
			margin-bottom: 16px;
			resize: vertical;
			background-color: #203169;
			color: white;
		}

		h1,
		h3 {
			font-family: 'Permanent Marker', cursive;
		}

		#Form {
			margin: 5px;
			padding: 5px;
			width: 20%;
		}

		table {
			table-layout: fixed;
		}

		td {
			word-wrap: break-word
		}

		#grad1 {
			background-image: linear-gradient(to top, #64646b, #717176, #7e7e82, #8c8b8d, #999999);
		}

		#grad2 {
			background-image: linear-gradient(to right top, #626262, #68686f, #6c6f7c, #6e7689, #6d7e97, #72839f, #7789a7, #7c8eaf, #8b92b2, #9995b4, #a699b5, #b19eb6);
		}

		.container {
			border-radius: 5px;
			background-color: #f2f2f2;
			padding: 20px;
		}
            .container1{
      position: absolute;
      right: 0;
      width: 100%;
      min-height: 100vh;
      background: #f1f1f1;
}
	</style>
</head>
<body style="background-color: red;">
<div class="container1">
      <div class="header2">
            <div class="nav">
          <h1 >Notification</h1>  <br>   
            <div class="input-group mb-3" style="  width: 50%;padding-right: 50px;padding-left: 230px;">
            <br>    <br>   
                      <button class="btn btn-outline-light" type="button" id="button-addon1">Search</button>
                      <input type="text" class="form-control" placeholder="Enter ID Number........." aria-label="Example text with button addon" aria-describedby="button-addon1" >
            </div>
               
            </div>
            <a class="btn btn-outline-light" href="RAP_dashboard.php" role="button" style="height: 40px; width: 150px; padding-right:10px;margin-right: 10px;">Back</a>       
      </div>
      <div class="side_menu1"></div>
      <div id="filterButtons" style="margin-top: 10%;position:absolute; " >
							<table width="100%" cellspacing="0" cellpadding="0" id="filterTable">
								<tbody>
									<tr>
										<form >
											<td>
												<div >
                          <form>
    
                          </form>
													<!-- <select name="requestType1" id="type">
														<option value="" disabled selected hidden>Choose Request type</option>
														<option value="Absent - for lecture">Absent - for lecture</option>
														<option value="Absent - for lab session">Absent - for lab session</option>
														<option value="Repeat exams">Repeat exams</option>
														<option value="Recorrection">Recorrection</option>
														<option value="Feedback">Feedback</option>
														<option value="Other">Other</option>
													</select> -->
												</div>
											</td>
											<td>
												<div >
													<select name="orderBy1" id="order" >
														<option value="latest" selected="selected">Latest</option>
														<option value="oldest">Oldest</option>
														
													</select>
												</div>
											</td>
											<td>
												<input type="submit" value="Apply filter" id="applyFilter" >
											</td>
										</form>
									</tr>
								</tbody>
							</table>

						</div>
     
      <div class="Center"><div>
      <table class="table table-primary table-hover" >
        
      <!-- </div></div> -->
  <thead>
    <tr>
      <th scope="col">ID Number</th>
      <th scope="col">Applicant Name</th>
      <th scope="col">Appointment Time</th>
      <th scope="col">Received Date</th>
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
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>

    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td colspan="2">Larry the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>
      </div>
   
</div></div>

</body>
</html>