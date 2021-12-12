   function horaActual() {
      fecha=new Date(); //Actualizar fecha.
      hora=fecha.getHours(); //hora actual
      minuto=fecha.getMinutes(); //minuto actual
      segundo=fecha.getSeconds(); //segundo actual
      if (hora<=10) { //dos cifras para la hora
         hora=hora;
      }
      if (minuto<10) { //dos cifras para el minuto
         minuto="0"+minuto;
      }
      if (segundo<10) { //dos cifras para el segundo
         segundo="0"+segundo;
      }
      var sufijo = ' am';
      if(hora > 12) {
         hora = hora - 12;
         sufijo = ' pm';
      }

      reloj = +" "+hora+": "+minuto+": "+segundo + sufijo;	
      return reloj; 
   }
      
   function actualizar() { //función del temporizador
      hora=horaActual(); //recoger hora actual
      reloj=document.getElementById("reloj"); //buscar elemento reloj
      reloj.innerHTML=hora; //incluir hora en elemento
   }
   setInterval(actualizar,1000); //iniciar temporizador