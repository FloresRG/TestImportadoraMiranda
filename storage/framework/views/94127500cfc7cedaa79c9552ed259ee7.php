<!-- Modal de cantidad -->
<div id="cantidadModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="cantidadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cantidadModalLabel">Ingrese la cantidad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="number" id="cantidad-input" class="form-control" placeholder="Cantidad" min="1" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" id="confirmar-cantidad" class="btn btn-primary">Agregar al carrito</button>
            </div>
        </div>
    </div>
</div><?php /**PATH D:\TESTIMPORTADORA\TestImportadoraMiranda\resources\views/control/partials/quantity-modal.blade.php ENDPATH**/ ?>