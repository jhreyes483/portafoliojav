




<!DOCTYPE html>
<html lang="es">

<head>

   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="">
   <meta name="author" content="">

   <title>SICLOUD</title>

   <!-- Custom fonts for this template-->





   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">



   <!-- Custom styles for this template-->


   <script>
      //fetch('https://jfa.herokuapp.com/mailapi/src/').
      fetch('https://portafoliojav.herokuapp.com/mailapi/src/')
      .then((respuesta)  =>{
         return respuesta.json();
      }).then((respuesta) =>{
         document.getElementById('msg').value = respuesta.msg;
         console.log(respuesta);
      })

   </script>

</head>


<body id="page-top">
<br><br><br><br><br>
<div class="container">
   <div class="rows">
   <form action="https://portafoliojav.herokuapp.com/mailapi/src/" method="post">
      <div class="card card-body">
         <div class="row">
         <div class="col-md-4">
         <label for="">Asunto</label>
            <input type="text" class="form-control"  name="asunto" id="">
         </div>
         <div class="col-md-4">
         <label for="">Envia</label>
            <input type="text" class="form-control" name="remitente" id="">
         </div>
         <div class="col-md-4">
         <label for="">Corrreo Destino</label>
            <input type="text" class="form-control" name="mailEnvio" id="">
         </div>
         <div class="col-md-12">
            <label for="">Titulo</label>
            <input class="form-control" type="text" name="titulo">
         </div>
         </div>
         <div class="col-md-12">
            <label for="">Mensaje</label>
            <textarea class="form-control" name="body" id="" cols="30" rows="3"></textarea>
         </div>
         <input type="submit" value="Enviar correo" name="enviar" class="my-2  btn btn-primary">

          
        
      

      </div>
      <input type="hidden" name="format" value="html">
      </form>
   </div>
</div>
<input type="text" name="" id="msg">

</body>


</html>