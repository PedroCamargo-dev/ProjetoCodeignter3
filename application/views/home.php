<?php if ($users[0]->idFunction == '1') : ?>


<?php elseif ($users[0]->idFunction == '3' || $users[0]->idFunction == '2') : ?>
    <div class="container">
        <div class="row">
            <h2>Pedido <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z" />
                </svg><span class="fs-6 font-monospace"> Veja todos os pedidos</span></h2>
            <div class="d-grid gap-2 mt-2 d-md-flex justify-content-md-start">
                <a href="<?php base_url()?>pedido" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg>Novo Pedido</a>
            </div>
        </div>
        <hr class="my-3">
    </div>
<?php endif; ?>