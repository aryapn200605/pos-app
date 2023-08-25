import Swal from "sweetalert2";
import "sweetalert2/dist/sweetalert2.css";

export function alert(title, message, icon) {
  Swal.fire(title, message, icon);
}
