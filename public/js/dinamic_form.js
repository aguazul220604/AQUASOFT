//// Servicios
const serviceSelect = document.getElementById("service");
const serviceForms = {
    service1: document.getElementById("form-service1"),
    service2: document.getElementById("form-service2"),
    service3: document.getElementById("form-service3"),
};

const noCabinsMessage = document.querySelector("#no-cabins-message");

serviceSelect.addEventListener("change", function () {
    for (let key in serviceForms) {
        if (serviceForms[key]) {
            serviceForms[key].classList.add("hidden");
        }
    }

    const selectedService = serviceSelect.value;

    if (selectedService === "service2" && noCabinsMessage) {
        noCabinsMessage.classList.remove("hidden");
    } else {
        noCabinsMessage?.classList.add("hidden");
        if (serviceForms[selectedService]) {
            serviceForms[selectedService].classList.remove("hidden");
        }
    }
});

///// Servicio: Albercas
const totalInput = document.getElementById("total1");
const edad1 = document.getElementById("edad1");
const edad2 = document.getElementById("edad2");
const edad3 = document.getElementById("edad3");
const monto = document.getElementById("monto_gratis");
const personas = document.getElementById("total_personas1");
const entradasGratisInput = document.getElementById("entradas_gratis");
const totalPersonas2 = document.getElementById("total_personas2");

const precioEdad1 = parseFloat(edad1.getAttribute("data-price-ed1"));
const precioEdad2 = parseFloat(edad2.getAttribute("data-price-ed2"));
const precioEdad3 = parseFloat(edad3.getAttribute("data-price-ed3"));
const mg = parseFloat(monto.getAttribute("data-monto"));

const personasPorBoletoGratis = parseInt(
    totalPersonas2.getAttribute("data-personas")
);

const actualizarTotal = () => {
    const cantidadEdad1 = parseFloat(edad1.value) || 0;
    const cantidadEdad2 = parseFloat(edad2.value) || 0;
    const cantidadEdad3 = parseFloat(edad3.value) || 0;

    const tp = cantidadEdad1 + cantidadEdad2 + cantidadEdad3;

    const total =
        cantidadEdad1 * precioEdad1 +
        cantidadEdad2 * precioEdad2 +
        cantidadEdad3 * precioEdad3;

    const boletosGratis = Math.floor(tp / personasPorBoletoGratis);

    personas.value = tp;
    entradasGratisInput.value = boletosGratis;

    const montoGratis = boletosGratis * mg;
    monto.value = montoGratis.toFixed(2);

    totalInput.value = total.toFixed(2) - montoGratis.toFixed(2);
};
edad1.addEventListener("input", actualizarTotal);
edad2.addEventListener("input", actualizarTotal);
edad3.addEventListener("input", actualizarTotal);
actualizarTotal();

///// Servicio: Cabañas
const totalInput2 = document.getElementById("total2");
const cantidadCabinsDisponibles = document.getElementById("ccd");
const tipoCabinSelect = document.getElementById("tipo_cabs");
const personasNumeroCabins = document.getElementById("npcb");
const alerta = document.getElementById("mensaje_alert");
const alerta2 = document.getElementById("alerta_pe");
const personasExtrasInput = document.getElementById("pe");
const cabsReservadasInput = document.getElementById("cr");
const cabsReservadasCont = document.getElementById("cabins_reservadas_cont");
const diasReservacionCantidad = document.getElementById("drc");

const servicioExtra = document.getElementById("servicio_extra");
const horarioServicioE = document.getElementById("horario_se");

alerta.classList.add("hidden");
alerta2.classList.add("hidden");

const cabinData = {
    1: {
        precio: parseFloat(
            document.getElementById("cab1").getAttribute("data-price-cb1")
        ),
        capacidad: 3,
    },
    2: {
        precio: parseFloat(
            document.getElementById("cab2").getAttribute("data-price-cb2")
        ),
        capacidad: 3,
    },
    3: {
        precio: parseFloat(
            document.getElementById("cab3").getAttribute("data-price-cb3")
        ),
        capacidad: 5,
    },
};

function calcularTotal() {
    const tipoCabin = parseInt(tipoCabinSelect.value);
    const diasReservacion = parseInt(diasReservacionCantidad.value) || 0;
    const personas = parseInt(personasNumeroCabins.value) || 0;
    const cabsDisponibles = parseInt(cantidadCabinsDisponibles.value) || 0;

    const { precio, capacidad } = cabinData[tipoCabin];

    const capacidadEstimada = Math.ceil(personas / capacidad);
    const personasExtra = Math.max(
        0,
        personas - capacidadEstimada * (capacidad - 1)
    );

    if (
        capacidadEstimada > cabsDisponibles ||
        personasExtra > capacidadEstimada
    ) {
        alerta.classList.remove("hidden");
        cabsReservadasCont.classList.add("hidden");
        alerta2.classList.add("hidden");
        totalInput2.value = "0.00";
    } else {
        alerta.classList.add("hidden");
        if (personasExtra != 0) {
            cabsReservadasCont.classList.remove("hidden");
            alerta2.classList.remove("hidden");
            personasExtrasInput.value = personasExtra;
        } else {
            cabsReservadasCont.classList.remove("hidden");
            alerta2.classList.add("hidden");
        }
        cabsReservadasInput.value = capacidadEstimada;
        const total2 =
            (precio * capacidadEstimada + personasExtra * 100) *
            diasReservacion;
        totalInput2.value = total2.toFixed(2);
    }
}
function toggleHorarioServicio() {
    if (servicioExtra.value === "1") {
        horarioServicioE.classList.remove("hidden");
    } else {
        horarioServicioE.classList.add("hidden");
    }
}
personasNumeroCabins.addEventListener("input", calcularTotal);
tipoCabinSelect.addEventListener("change", calcularTotal);
diasReservacionCantidad.addEventListener("input", calcularTotal);
servicioExtra.addEventListener("change", toggleHorarioServicio);

///// Servicio: Camping
const totalInput3 = document.getElementById("total3");
const personasNumeroCamping = document.getElementById("npc");
const totalPersonasCamping = document.getElementById("total_personas2_camp");
const entradasGratisInput2 = document.getElementById("entradas_gratis2");
const montoGratisInput2 = document.getElementById("monto_gratis2");
const precioPorPersona = parseFloat(
    personasNumeroCamping.getAttribute("data-price3")
);
const personasPorBoletoGratis2 = parseInt(
    totalPersonasCamping.getAttribute("data-personas2")
);
const descuentoPorBoletoGratis2 = parseFloat(
    montoGratisInput2.getAttribute("data-monto2")
);
const actualizarTotalCamping = () => {
    const cantidadPersonas = parseInt(personasNumeroCamping.value) || 0;
    const boletosGratis = Math.floor(
        cantidadPersonas / personasPorBoletoGratis2
    );
    const montoGratis = boletosGratis * descuentoPorBoletoGratis2;
    const totalSinDescuento = cantidadPersonas * precioPorPersona;
    const totalConDescuento = totalSinDescuento - montoGratis;
    entradasGratisInput2.value = boletosGratis;
    montoGratisInput2.value = montoGratis.toFixed(2);
    totalInput3.value = totalConDescuento.toFixed(2);
};
personasNumeroCamping.addEventListener("input", actualizarTotalCamping);
actualizarTotalCamping();



// Gestión de envío de formulario de pago

fetch('/stripe-key')
    .then(response => response.json())
    .then(data => {
        const stripe = Stripe(data.key);
        const elements = stripe.elements();
        const card = elements.create('card', { hidePostalCode: true });
        card.mount('#card-element');  // Monto el elemento de la tarjeta en el contenedor con id 'card-element'

        // Obtener el botón y el área de errores
        const payButton = document.getElementById('pay-button');
        const cardErrors = document.getElementById('card-errors');

        // Escuchar los cambios en la tarjeta
        card.addEventListener('change', function(event) {
            if (event.error) {
                cardErrors.textContent = event.error.message; // Muestra el mensaje de error
                payButton.disabled = true; // Deshabilita el botón de pago
            } else {
                cardErrors.textContent = ''; // Limpia los errores si no hay
                payButton.disabled = !event.complete; // Habilita el botón de pago solo cuando la tarjeta es válida
            }
        });
    })
    .catch(error => console.error('Error obteniendo la clave:', error));  // Muestra el error si no se obtiene la clave
