const formulariosAjax = document.querySelectorAll(".formularioAjax");

function enviarFormularioAjax(e) {
  e.preventDefault();

  let data = new FormData(this);
  let method = this.getAttribute("method");
  let action = this.getAttribute("action");
  let tipo = this.getAttribute("data-form");
  let encabezados = new Headers();

  let config = {
    method: method,
    headers: encabezados,
    mode: "cors",
    cache: "no-cache",
    body: data,
  };

  let textoAlerta;

  if (tipo === "save") {
    textoAlerta = "Los datos se guardaran en el sistema";
  } else if (tipo === "delete") {
    textoAlerta = "Los datos se eliminaran del sistema";
  } else if (tipo === "update") {
    textoAlerta = "Los datos se actualizaran del sistema";
  } else if (tipo === "search") {
    textoAlerta = "Se elimnara el termino de busqueda";
  } else if (tipo === "loans") {
    textoAlerta = "Desea remover los datos especiales";
  } else {
    textoAlerta = "Quieres realizar esta operacion?";
  }

  Swal.fire({
    title: "Estas seguro?",
    text: textoAlerta,
    type: "question",
    showCancelButton: true,
    confirmButtonText: "Aceptar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.value) {
      fetch(action, config)
        .then((respuesta) => respuesta.json())
        .then((respuesta) => {
          return alertasAjax(respuesta);
        });
    }
  });
}

formulariosAjax.forEach((formularios) => {
  formularios.addEventListener("submit", enviarFormularioAjax);
});

/* Alertas */
function alertasAjax(alerta) {
  if (alerta.Alerta === "simple") {
    Swal.fire({
      title: alerta.Titulo,
      text: alerta.Texto,
      type: alerta.Tipo,
      confirmButtonText: "Aceptar",
      allowOutsideClick: false,
    });
  } else if (alerta.Alerta === "html") {
    Swal.fire({
      title: alerta.Titulo,
      html: alerta.Texto,
      type: alerta.Tipo,
      confirmButtonText: "Aceptar",
      allowOutsideClick: false,
    });
  } else if (alerta.Alerta === "recargar") {
    Swal.fire({
      title: alerta.Titulo,
      text: alerta.Texto,
      type: alerta.Tipo,
      confirmButtonText: "Aceptar",
      allowOutsideClick: false,
    }).then((result) => {
      if (result.value) {
        location.reload();
      }
    });
  } else if (alerta.Alerta === "limpiar") {
    Swal.fire({
      title: alerta.Titulo,
      text: alerta.Texto,
      type: alerta.Tipo,
      confirmButtonText: "Aceptar",
      allowOutsideClick: false,
    }).then((result) => {
      if (result.value) {
        document.querySelector(".formularioAjax").reset();
      }
    });
  } else if (alerta.Alerta === "redireccionar") {
    window.location.href = alerta.Url;
  } else if (alerta.Alerta === "redireccionarUser") {
    Swal.fire({
      title: alerta.Titulo,
      text: alerta.Texto,
      type: alerta.Tipo,
      confirmButtonText: "Aceptar",
      allowOutsideClick: false,
    }).then((result) => {
      if (result.value) {
        window.location.href = alerta.Url;
      }
    });
  }
}
