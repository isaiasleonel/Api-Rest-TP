{include file="header.tpl"}

<section class="container-fluid my-5 mb-5">
    {foreach from=$productos item=newBD}
        <div class="row bg-white py-5">
            <div class="col-md-6 mb-4 mb-md-0">
                <div class="col-12 mb-0">
                    <figure class="rounded text-center">
                        <img src="{$newBD->imagen}" class="img-fluid rounded" alt="img-product" />
                    </figure>
                </div>
            </div>
            <div class="col-md-6">
                <h2><strong>{$newBD->nombre} | {$newBD->marca_fk}</strong></h2>
                <!-- <p class="mb-2 text-muted text-uppercase small">Categoria</p> -->
                <p class="h2">
                    <strong class="text-primary">${$newBD->precio}</strong>
                </p>
                <!---<p class="pt-1">
                    Esta réplica cuenta con soporte de trabajo, suspensión delantera,
                    palanca de cambio de marcha, palanca de freno de pie, cadena de
                    transmisión, ruedas y dirección. Todas las piezas son
                    particularmente delicadas debido a su escala precisa y requieren
                    especial cuidado y atención.
                </p>-->
                <hr />
                <div class="mb-2">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td class="pl-0 pb-0 w-25">Cantidad</td>
                            </tr>
                            <tr>
                                <td class="row">
                                    <div class="list-group list-group-horizontal mx-0 col-6">
                                        <button class="list-group-item col-1 py-2" style="border: 1px solid #a3a8ad">
                                            <strong>-</strong>
                                        </button>
                                        <input class="col-5 col-md-4" min="0" name="quantity" value="1" type="number" />
                                        <button class="list-group-item col-1 py-2" style="border: 1px solid #a3a8ad">
                                            <strong>+</strong>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-primary py-2 mr-1 mb-2">
                    Comprar ahora
                </button>
                <button type="button" class="btn btn-success py-2 mr-1 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="16" height="16" viewBox="0 0 172 172"
                        style="fill: #000000">
                        <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt"
                            stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0"
                            font-family="none" font-weight="none" font-size="none" text-anchor="none"
                            style="mix-blend-mode: normal">
                            <path d="M0,172v-172h172v172z" fill="none"></path>
                            <g fill="#ffffff">
                                <path
                                    d="M10.75,10.75v10.75h21.5c2.30957,0 4.28321,1.51172 5.03906,3.69531l10.03614,89.52734c0.92382,8.14649 7.89453,14.31933 16.04101,14.31933c-5.45898,0.5879 -9.61621,5.20703 -9.61621,10.70801c0,5.9209 4.8291,10.75 10.75,10.75c5.9209,0 10.75,-4.8291 10.75,-10.75c0,-5.50098 -4.19922,-10.12011 -9.6582,-10.70801h51.52441c-5.45898,0.5879 -9.61621,5.20703 -9.61621,10.70801c0,5.9209 4.8291,10.75 10.75,10.75c5.9209,0 10.75,-4.8291 10.75,-10.75c0,-5.50098 -4.19922,-10.12011 -9.7002,-10.70801h9.7002v-10.75h-65.63379c-2.77148,0 -5.03906,-1.97362 -5.333,-4.74511l-0.67187,-6.04687h68.19531c7.64257,0 14.31933,-5.45898 15.83105,-12.93359l10.28808,-51.56641h-11.92578v4.87109l-8.90234,44.55371c-0.5459,2.56153 -2.6875,4.3252 -5.29101,4.3252h-69.45508l-8.31445,-74.1582l-0.16797,-0.50391c-2.05763,-6.71875 -8.31446,-11.3379 -15.36915,-11.3379zM86,21.5v21.5h-21.5v10.75h21.5v21.5h10.75v-21.5h21.5v-10.75h-21.5v-21.5z">
                                </path>
                            </g>
                        </g>
                    </svg>
                    Agregar a la cesta
                </button>
            </div>
        </div>
    {{/foreach}}
</section>

{include file="footer.tpl"}