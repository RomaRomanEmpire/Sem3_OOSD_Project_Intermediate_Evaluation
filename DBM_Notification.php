<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Notification</title>
      <link rel="stylesheet" href="bootstrap.css">
      <style>
      body {
			font-family: Arial, Helvetica, sans-serif;
      background: rgb(10,30,235); 
      background: linear-gradient(90deg, rgba(10,30,235,1) 0%, rgba(15,132,139,1) 41%, rgba(15,30,135,1) 100%, rgba(101,181,198,1) 100%);          
		
                  min-height: 100vh;}
    .header1 {
            position: fixed;
            top: 0;
            right: 0;
            height: 19vh;
            width: 100%;
            
            display: flex;
            align-items: center;
            justify-content: right;
            z-index: 3;

        }
  </style>
</head>
<body>
<div class="header1">
<div style="padding-right:600px;">
   <form >
     <table>
    <tr >
   <td style="padding-right:0%;"><button type="submit" style="padding-right:10px;"><img src="Image/search.png" alt="" style="width: 40px;height:37px;"></button></td>
   <td style="padding-left:0%;"><input type="text" placeholder="    search....." style="width: 650px;height:40px; margin-left:0%;   background-color: #f7f2f2;"></td>
  </tr> 
  </table> 
  </form> 
  </div>
  <div>
  <a href="DatabaseManagerDashboard.php"><button type="submit" class="btn btn-sm btn-outline-light" style="width: 100px;font-size:18px;margin-right:20px;"><b style="color:#000; ">Back</b> </button></a>
</div>
</div>
 
 <div >
<div style="padding: 100px;padding-top:200px;color: white; background: rgb(10,30,235);background: linear-gradient(90deg, rgba(10,30,235,1) 0%, rgba(15,132,139,1) 41%, rgba(15,30,135,1) 100%, rgba(101,181,198,1) 100%);">
 <fieldset id="table_detils" >
       <table  class="table table-striped table-hover" style="text-align: center;font-weight:bolder; " >
         <thead style="font-size:20px;">
           <tr class="table-info" >
           <th scope="col" id="Email" >Notification ID</th>
           <th scope="col" id="Email" >Sent date</th>
             <th scope="col" id="IdNumber" >Sender</th>
             <th scope="col" id="Username" >Recever</th>
             <th scope="col" id="Action">Subject</th>
           </tr>
         </thead>
         <tbody >
         <tr scope="row" style="font-size: large;" >
                    <td  style="color: whitesmoke;"></td>
                    <td  style="color: whitesmoke;"></td>
                    <td style="color: whitesmoke;"></td>
                    <td style="color: whitesmoke;"></td>
                    <td  style="color: whitesmoke;"> </td>
           </tr>
        </tbody>
            </table>
       


      </fieldset>



</div></div>
</body>
</html>