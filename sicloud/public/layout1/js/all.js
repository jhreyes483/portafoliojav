function PopupCenter(url, title, w, h) {
   // Fixes dual-screen position                         Most browsers      Firefox
   var dualScreenLeft =
     window.screenLeft != undefined ? window.screenLeft : screen.left;
   var dualScreenTop =
     window.screenTop != undefined ? window.screenTop : screen.top;
 
   width = window.innerWidth
     ? window.innerWidth
     : document.documentElement.clientWidth
     ? document.documentElement.clientWidth
     : screen.width;
   height = window.innerHeight
     ? window.innerHeight
     : document.documentElement.clientHeight
     ? document.documentElement.clientHeight
     : screen.height;
 
   var left = width / 2 - w / 2 + dualScreenLeft;
   var top = height / 2 - h / 2 + dualScreenTop;
   var newWindow = window.open(
     url,
     title,
     "scrollbars=yes, width=" +
       w +
       ", height=" +
       h +
       ", top=" +
       top +
       ", left=" +
       left
   );
 
   // Puts focus on the newWindow
   if (window.focus) {
     newWindow.focus();
   }
 }


 function dataTable(id){
  $(document).ready(function() {    
    document.getElementById(id).DataTable({        
        language: {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
			     },
			     "sProcessing":"Procesando...",
            },
        //para usar los botones   
        responsive: "true",
        dom: 'Bfrtilp',       
        buttons:[ 
			{
				extend:    'excelHtml5',
				text:      '<i class="far fa-file-excel" ></i> ',
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-success mr-3 col-sm-1 col-md-4 rounded-circle'
			},
			{
				extend:    'pdfHtml5',
				text:      '<i class="fas fa-file-pdf" ></i> ',
				titleAttr: 'Exportar a PDF',
				className: 'btn btn-danger mr-3 col-sm-1 col-md-4 rounded-circle'
			},
			{
				extend:    'print',
				text:      '<i class="fa fa-print "></i> ',
				titleAttr: 'Imprimir',
				className: 'btn btn-info col-sm-1 col-md-4 rounded-circle'
			},
		]	        
    });     
});



 }
 