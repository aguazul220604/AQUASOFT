document.addEventListener("DOMContentLoaded", function () {
    let html5QrcodeScanner;
    const qrContentElement1 = document.getElementById("qr-content1");
    const qrContentElement2 = document.getElementById("qr-content2");
    const serviceIconElement = document.getElementById("service");
    const modalElement = document.getElementById("escaner");
    const modalInstance = new bootstrap.Modal(modalElement);

    modalElement.addEventListener("shown.bs.modal", function () {
        html5QrcodeScanner = new Html5Qrcode("reader");
        html5QrcodeScanner
            .start(
                { facingMode: "environment" },
                { fps: 10, qrbox: { width: 250, height: 250 } },
                (qrCodeMessage) => {
                    const [idPago, tipoServicio] =
                        qrCodeMessage.split("service");
                    qrContentElement1.value = idPago.trim();
                    qrContentElement2.value = `service${tipoServicio.trim()}`;
                    serviceIconElement.className = "";
                    const detectedService = `service${tipoServicio.trim()}`;
                    if (detectedService === "service1") {
                        serviceIconElement.classList.add(
                            "bi",
                            "bi-droplet-half"
                        );
                    } else if (detectedService === "service2") {
                        serviceIconElement.classList.add(
                            "bi",
                            "bi-house-heart"
                        );
                    } else if (detectedService === "service3") {
                        serviceIconElement.classList.add("bi", "bi-tree");
                    } else {
                        console.warn("Servicio desconocido:", detectedService);
                    }
                    html5QrcodeScanner
                        .stop()
                        .then(() => {
                            console.log("Escáner detenido.");
                            document.getElementById("reader").style.display =
                                "none";
                        })
                        .catch((err) => {
                            console.error("Error al detener el escáner: ", err);
                        });
                }
            )
            .catch((err) => {
                console.error("No se pudo iniciar el escáner: ", err);
            });
    });

    modalElement.addEventListener("hidden.bs.modal", function () {
        if (html5QrcodeScanner) {
            html5QrcodeScanner
                .stop()
                .then(() => {
                    console.log("Escáner detenido.");
                })
                .catch((err) => {
                    console.error("Error al detener el escáner: ", err);
                });
        }
        document.getElementById("reader").style.display = "block";
        qrContentElement1.value = "";
        qrContentElement2.value = "";
    });

    document
        .getElementById("confirmButton")
        .addEventListener("click", function () {
            Swal.fire({
                icon: "success",
                title: "QR escaneado",
                text: "¡El ticket ha sido escaneado con éxito!",
                confirmButtonText: "Aceptar",
                confirmButtonColor: "#2c8a19",
            }).then((result) => {
                if (result.isConfirmed) {
                    modalInstance.hide();
                    qrContentElement1.value = "";
                    qrContentElement2.value = "";
                    document.getElementById("reader").style.display = "block";
                }
            });
        });
});
