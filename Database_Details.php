<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="bootstrap.css">
  <title>Document</title>
  <script src="Javascipt_File.js">
  </script>
</head>
<body>
  <div><div style="padding: 100px; ">
    <div style="margin: 100px;">
      <form >
        <fieldset id="Disable_Tag" >
          <h2 style="color: black;  ">View Database Deatails</h2>
          <br>
          <div class="mb-3 form-check">
            <input type="radio" class="form-check-input" name="officer" id="Officer_E" onclick="show_details()">
            <label class="form-check-label" for="Officer_E">Estate Superintendent</label>
          </div>
          <div class="mb-3 form-check">
            <input type="radio" class="form-check-input" name="officer" id="Officer_D" onclick="show_details()">
            <label class="form-check-label" for="Officer_D">Divitional Secretary</label>
          </div> <div class="mb-3 form-check">
            <input type="radio" class="form-check-input" name="officer" id="Officer_G" onclick="show_details()">
            <label class="form-check-label" for="Officer_G">Grama Niladari</label>
          </div> <div class="mb-3 form-check">
            <input type="radio" class="form-check-input" name="officer" id="Officer_P" onclick="show_details()">
            <label class="form-check-label" for="Officer_P">Principal</label>
          </div>
          <div class="mb-3 form-check">
            <input type="radio" class="form-check-input" name="officer" id="Officer_N" onclick="show_details()">
            <label class="form-check-label" for="Officer_N">National Identity Card Issuer</label>
          </div> 
          <div class="mb-3 form-check">
            <input type="radio" class="form-check-input" name="officer" id="student" onclick="show_details()">
            <label class="form-check-label" for="student">Student</label>
          </div>
          <div class="mb-3 form-check">
            <input type="radio" class="form-check-input" name="officer" id="person" onclick="show_details()">
            <label class="form-check-label" for="person">Person</label>
          </div>
          <div class="mb-3 form-check">
            <input type="radio" class="form-check-input" name="officer" id="monk" onclick="show_details()">
            <label class="form-check-label" for="monk">Monk</label>
          </div>
          
          
          
          
          
          
        </fieldset> </form></div>
        <fieldset id="table_detils" >
          <table  class="table table-striped table-hover"  >
            <thead>
              <tr>
                <th scope="col" class="IdNumber" style="display: none;">ID Number</th>
                <th scope="col" class="Username" style="display: none;">Username</th>
                <th scope="col" class="Email" style="display: none;">Email</th>
                <th scope="col" class="Estate_Address" style="display: none;">Estate Address</th>
                <th scope="col" class="Grama_Niladari_Divition" style="display: none;">Grama Niladari Divition</th>
                <th scope="col" class="Divitional_Secretariat" style="display: none;">Divitional Secretariat</th>
                <th scope="col" class="School_Name" style="display: none;">School Name</th> 
                <th scope="col" class="Action" style="display: none;">Action</th>
              </tr>
            </thead>
            <tbody>


              <?php 
              
              foreach($products as $i => $product):?>
                <tr scope="row">
                  <td class="IdNumber" style="display: none;">1</td>
                  <td class="Username"style="display: none;">1234</td>
                  <td class="Email"style="display: none;">123</td>
                  <td class="Estate_Address" style="display: none;">Estate Address</td>
                  <td class="Grama_Niladari_Divition" style="display: none;">34</td>
                  <td class="Divitional_Secretariat" style="display: none;">24</td>
                  <td class="School_Name" style="display: none;">234</td>
                  <td class="Action" style="display: none;">
                    <form style="display: inline-block" >
                      <input type="hidden" name="id" >
                      <button  type="submit" class="btn btn-sm btn-outline-danger" >Remove Account</button>
                    </form>
                  </td>
                </tr>
                
              <?php endforeach; ?>

            </tbody>
          </table></fieldset>
        </div></div>
      </body>
      </html>