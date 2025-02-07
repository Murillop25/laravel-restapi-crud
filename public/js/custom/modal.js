document.addEventListener("DOMContentLoaded", function() {
    // Evento para abrir el modal y cargar el formulario dinámico
    document.querySelectorAll('[data-bs-target="#modalStudent"]').forEach(button => {
        button.addEventListener("click", function() {
            let url = this.getAttribute("data-url");

            fetch(url)
                .then(response => response.text())
                .then(html => {
                    document.getElementById("formStudent").innerHTML = html;
                    // Inicializar el modal de Bootstrap
                    let modalElement = document.getElementById('modalStudent');
                    let modal = new bootstrap.Modal(modalElement);
                    modal.show();
                })
                .catch(error => console.error("Error al cargar el formulario:", error));
        });
    });
});

// Enviar el formulario con AJAX
document.addEventListener("submit", function(event) {
    if (event.target.id === "studentForm") {
        event.preventDefault();

        let formData = new FormData(event.target);
        let studentId = document.getElementById("student_id")?.value; // Detectar si es edición o creación
        let url = studentId ? `/students/${studentId}` : "/students"; 
        let method = studentId ? "PUT" : "POST"; 

        fetch(url, {
            method: method,
            body: formData,
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(errorData => {
                    throw new Error(errorData.message || "Error en la respuesta del servidor");
                });
            }
            return response.json();
        })
        .then(data => {
            alert(studentId ? "Estudiante actualizado con éxito" : "Estudiante creado con éxito");
            document.getElementById("modalStudent").querySelector(".btn-close").click();
            // Aquí puedes agregar código para actualizar la lista de estudiantes sin recargar la página
            // Por ejemplo, puedes hacer una nueva solicitud para obtener la lista actualizada de estudiantes
        })
        .catch(error => {
            console.error("Error al guardar:", error);
            alert("Error: " + error.message);
        });
    }
});