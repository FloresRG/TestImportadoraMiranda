<!-- Modal para el QR -->
<div id="qrModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="qrModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="qrModalLabel">Código QR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="<?php echo e(asset('images/QR.jpeg')); ?>" alt="Código QR" style="max-width: 100%; max-height: 100%;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cerrar-qr-modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="regresar-carrito" data-toggle="modal" data-target="#carritoModal" data-dismiss="modal">
                    Regresar al Carrito
                </button>
            </div>
        </div>
    </div>
</div><?php /**PATH D:\TESTIMPORTADORA\TestImportadoraMiranda\resources\views/control/partials/qr-modal.blade.php ENDPATH**/ ?>