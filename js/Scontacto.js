document.addEventListener("DOMContentLoaded", function() {
    document.querySelector("form[name='gps_connect']").addEventListener("submit", function(event) {
        event.preventDefault();

        
        const nombre = document.getElementById("nombre").value.trim();
        const apellido = document.getElementById("apellido").value.trim();
        const telefono = document.getElementById("telefono").value.trim();
        const correo = document.getElementById("correo").value.trim();
        const mensaje = document.getElementById("mensaje").value.trim();

        if (nombre === "" || apellido === "" || telefono === "" || correo === "" || mensaje === "") {
            alert("Todos los campos son obligatorios.");
            return;
        }

        const formData = new FormData(this);

        fetch("php/Pcontacto.php", {
            method: "POST",
            body: formData
        })
        

        .then(response => response.text())
        .then(data => {
            alert(data);
            document.getElementById("nombre").value = "";
            document.getElementById("apellido").value = "";
            document.getElementById("telefono").value = "";
            document.getElementById("correo").value = "";
            document.getElementById("mensaje").value = "";
        })
        .catch(error => console.error("Error:", error));
    });
});
