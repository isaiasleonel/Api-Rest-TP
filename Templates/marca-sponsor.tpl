{include 'header.tpl'}

<!--------------- Vista al Administrador---------------->
{if isset($smarty.session.USER_ID)}

    <div class="containerTable mb-5 ">
        <h5 class="my-2"> Mostrando <strong>{$count}</strong> marcas</h5>
        <table class="table bg-white rounded">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Imagen</th>
                </tr>
            </thead>
            <tbody>
                {foreach  from= $marcas item=marca}
                    <tr>
                        <th scope="row">{$marca->id}</th>
                        <td>${$marca->marca_fk}</td>
                        <td><img src="{$marca->img}" width="50"></td>
                        </td>
                    </tr>
                {{/foreach}}
            </tbody>
        </table>
        <!------  Vista al usuarios-------->
    {else}
        <h2 class="text-primary my-5 "> Nuestros Sponsors </h2>
        <div class="row my-5 cards-sponsor row-cols-1 row-cols-md-4 g-3">
            {foreach  from= $marcas item=marca}
                <div class="col">
                    <div class="card h-100">
                        <img src="{$marca->img}" class="card-img-top" width="100" height="140" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{$marca->marca_fk}</h5>
                        </div>
                    </div>
                </div>
            {/foreach}
        </div>
    {/if}

{include file='footer.tpl'}