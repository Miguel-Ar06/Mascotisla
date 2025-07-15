document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formCasos');
    
    // Mostrar botón cancelar si estamos en modo edición
    const operation = document.querySelector('input[name="operation"]').value;
    if (operation === 'update') {
        document.getElementById('btnCancelEdit').style.display = 'inline-block';
        document.querySelector('button[type="submit"]').textContent = 'Actualizar Caso';
    }

    form.addEventListener('submit', function(e) {
        const operation = document.querySelector('input[name="operation"]').value;
        if (operation === 'update') {
            const casoId = document.querySelector('input[name="casoId"]').value;
            if (!casoId || casoId <= 0) {
                e.preventDefault();
                alert('ID de caso inválido para actualización');
                return false;
            }
            
            // Validar colaborador en modo edición
            const colaborador = document.querySelector('select[name="colaborador"]').value;
            if (!colaborador) {
                e.preventDefault();
                alert('Debe seleccionar un colaborador');
                return false;
            }
        }
        
        return true;
    });
});