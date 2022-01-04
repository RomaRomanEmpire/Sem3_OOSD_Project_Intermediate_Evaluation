<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Time Slot</title>
      <link rel="stylesheet" href="bootstrap.css">
      <style>
            body {
			font-family: Arial, Helvetica, sans-serif;
                  font-size: 20px;
			font-weight: bolder;
                  color:bisque;
                  min-height: 100vh;
                  background: rgb(2,0,36);
                  background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 1%, rgba(0,212,255,1) 100%);
                 
		}
           
            .Center{
                  padding: 50px;
                  padding-top: 200px;  
                  border-color: black;  
                 
                  }
            .header1 {
            position: fixed;
            top: 0;
            right: 0;
            height: 13vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: right;
            

        }
      

      </style>

</head>
<body >
      <div class="header1" style="padding-right:10px;">
      <a href="Filled_Application.php">
                                   <button type="submit" class="btn btn-sm btn-outline-light" style="width: 100px;font-size:18px;"><b style="color:#000; ">Back</b>
                                   </button>
                                  </a>
      </div>
     
            <div class="Center">

                  <fieldset id="time_slot" >
                  <h1 class="display-3">Send Appoinment Time</h1>
                  <br><br>
                  <form action="">
                  <div class="mb-3">
                            <label for="Date" class="form-label" style="font-size: 20px;">Appointment Date</label>
                            <input type="date" class="form-control"  id="Date"
                                   placeholder="Enter the appintment date" style=" background-color:bisque;">
                  </div>
                  <br>
                  <label for="exampleDataList" class="form-label" style="font-size: 20px;">Appointment Time</label>
                        <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search..." type="text" style=" background-color:bisque;">
                        <datalist id="datalistOptions">
                        <option value="San Francisco">
                        <option value="New York">
                        <option value="Seattle">
                        <option value="Los Angeles">
                        <option value="Chicago">
                        </datalist>
                  <br>
                  <button type="submit" class="btn btn-primary" style="width: 100px;">Submit</button>
                  </form>
                  </fieldset>
                  

                  </fieldset>
            </div>
    
</body>
</html>