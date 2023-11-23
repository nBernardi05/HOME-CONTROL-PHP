<!DOCTYPE html>
<html lang="it">
<head>
  <title>Verifica di tpsit</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>
      table {
          border:solid;
          width:100%;
      }
      td, tr {
          border:solid;
          font:100%;
          text-align:center;
          height:60px;
      }
      label {
          display:block;
          text-align:center;
      }
      input {
          width:100%;
          text-align:center;
      }
      input[type=submit] {
          margin-left:0px;
          margin-top:5px;
          margin-bottom:10px;
      }
      input[type=text] {
        width:100%;
        text-align:center;
      }
      form {
        text-align:center;
      }
  </style>
</head>
<body>

<div class="container-fluid p-5 bg-primary text-white text-center">
  <h1>HOME CONTROL</h1>
  <p>(C) Nicola Bernardi 2023</p> 
</div>
  
<div class="container mt-5">
  <div class="row">
    <div class="col-sm-4">
      <h3>Verifica TPSIT</h3>
      <p>Controlla la tua casa domotica da qui!</p>
    </div>

      <?php
        require("php/termometri.php");
      ?>

    
    <?php
        
        //require("reg.php")

     ?>
    
  </div>
</div>

</body>
</html>
