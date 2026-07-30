$('.btn-eliminar').click(function(event) {
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    Swal.fire({
    title: '¿Estas seguro?',
    text: "¡No podrás revertir esto!",
    showCancelButton: true,
    cancelButtonColor: '#3085d6',
    confirmButtonColor: '#d33',
    confirmButtonText: '¡Sí, bórralo!',
    cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    })
});

function myFunction() {
    document.getElementById("btn-aceptar").style.visibility = "hidden";
    setTimeout(() => document.getElementById("btn-aceptar").style.visibility = "visible", 3600);
};

// animaciones de carga-------------------------------------------
function loadingAnimation($text) {
    Swal.fire({
        title: $text,
        allowOutsideClick: false,
        showConfirmButton: false,
        allowEscapeKey: false,
        didOpen: () => {
            Swal.showLoading(); // Aquí mostramos la animación de carga
        },
    });
}


function errorMsg(text){
  Swal.fire({ 
    icon: 'error',
    title: 'Error',
    text: text,
    confirmButtonColor: '#dc3545',
    confirmButtonText: 'Aceptar' 
  });  
}
function warningMsg(text){
  Swal.fire({ 
    icon: 'warning',
    title: 'Atención',
    text: text,
    confirmButtonColor: '#ffc107',
    cancelButtonText: 'Aceptar',
    showConfirmButton: false,
    showCancelButton: true,
  });  
}
function successMsg(text){
  Swal.fire({ 
    icon: 'success',
    title: 'Éxito',
    text: text,
    confirmButtonColor: '#28a745',
    confirmButtonText: 'Aceptar' 
  });  
}

function limpiarRadios() {
  for (var i = 0; i < arguments.length; i++) {
    document.querySelectorAll('input[name="' + arguments[i] + '"]').forEach(function(radio) {
      radio.checked = false;
    });
  }
}