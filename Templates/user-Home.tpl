<h5 class="my-2"> Mostrando <strong>{$count}</strong> productos</h5>
{foreach from=$productos item=newBD}
    <div class="producto-class">
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-4 col-lg-auto px-2">
                    <img src="{$newBD->imagen}" class="img-fluid rounded-start" width="160" alt="...">
                </div>
                <div class="col-8">
                    <div class="card-body">
                        <h5 class="card-title">{$newBD->nombre}|{$newBD->marca_fk}</h5>
                        <p class="card-text">${$newBD->precio}</p>
                        <a type="button" class="btn btn-primary" href="descripcion/{$newBD->id_producto}">Ver
                            descripcion</a>
                    </div>
                </div>
            </div>
        </div>
    {{/foreach}}
</div>