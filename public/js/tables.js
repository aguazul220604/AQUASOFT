let lenguaje_esp = "https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json";

//Tickets

$(document).ready(function () {
    $("#tablaTickets").DataTable({
        stripeClasses: [],
        paging: true,
        language: {
            url: lenguaje_esp,
        },
    });
});

//Pagos

$(document).ready(function () {
    const tablas = [
        "#tablaAlbercas",
        "#tablaCabs",
        "#tablaCamping",
        "#tablaTotales",
    ];
    const configuracion = {
        stripeClasses: [],
        paging: true,
        language: {
            url: lenguaje_esp,
        },
        autoWidth: false,
        columnDefs: [
            { width: "10px", targets: 0 },
            { width: "100px", targets: "_all" },
        ],
    };

    tablas.forEach((tabla) => {
        $(tabla).DataTable(configuracion);
    });
});

//Reservaciones

$(document).ready(function () {
    $("#tablaReservaciones").DataTable({
        stripeClasses: [],
        paging: true,
        language: {
            url: lenguaje_esp,
        },
    });
});

//Usuarios

$(document).ready(function () {
    $("#tablasUsers").DataTable({
        stripeClasses: [],
        paging: true,
        language: {
            url: lenguaje_esp,
        },
    });
});

$(".formEliminar1").submit(function (e) {
    e.preventDefault();
    var form = this;
    Swal.fire({
        text: "¿Desea eliminar el registro?",
        icon: "warning",
        showCancelButton: true,
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#0d6efd",
        confirmButtonText: "Eliminar",
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                text: "Registro eliminado",
                icon: "success",
                confirmButtonColor: "#00532C",
                showConfirmButton: true,
            }).then(() => {
                form.submit();
            });
        }
    });
});

//Novedades

$(document).ready(function () {
    $("#tablasNovedades").DataTable({
        stripeClasses: [],
        paging: true,
        language: {
            url: lenguaje_esp,
        },
    });
});
