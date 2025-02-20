import { Notyf } from "notyf";
import "notyf/notyf.min.css";

const notyf = new Notyf({
  duration: 3000, // Duración de la alerta en ms
  position: { x: "right", y: "top" }, // Posición en la pantalla
  types: [
    { type: "success", background: "green", icon: "✅" },
    { type: "error", background: "red", icon: "❌" },
  ],
});

// Función para mostrar alertas
export function showAlert(type, message) {
    console.log('Hola desde notyf.js');
    
  notyf.open({ type, message });
}
