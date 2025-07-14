// scripts/casosForm.js
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formCasos');
    
    // Restaurar estado de edición al recargar
    const operation = document.querySelector('input[name="operation"]').value;
    if (operation === 'update') {
        document.getElementById('btnCancelEdit').style.display = 'inline-block';
        document.querySelector('button[type="submit"]').textContent = 'Actualizar Caso';
    }
    
    // Manejar envío del formulario
    form.addEventListener('submit', function(e) {
        const operation = document.querySelector('input[name="operation"]').value;
        
        // Validación adicional para actualización
        if (operation === 'update') {
            const casoId = document.querySelector('input[name="casoId"]').value;
            if (!casoId || casoId <= 0) {
                e.preventDefault();
                alert('ID de caso inválido para actualización');
                return false;
            }
        }
        
        return true;
    });
});