    {include 'header.tpl'}

    <div class="mt-5 w-50 mx-auto mb-5 ">
        <form class="py-5 px-5 bg-white" method="POST" action="agregar" enctype="multipart/form-data">
            <h3> Agregar nuevo producto</h3>
            <div class="form-group">
                <label for="precio">Precio</label>
                <input type="text" required class="form-control" name="precio" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" required class="form-control" name="nombre">
            </div>
            <hr>
            <h5> Seleccionar la nueva categoria</h5>
            <select class="form-select" name="categoria">
                {foreach  from= $categorias item=value}
                    <option value="{$value->id}">{$value->categoria_fk}</option>
                {/foreach}
            </select>
            <hr>
            <h5> Seleccionar la nueva marca</h5>
            <select class="form-select" name="marca">
                {foreach  from= $marcas item=value}
                    <option value="{$value->id}">{$value->marca_fk}</option>
                {/foreach}
            </select>
            <hr>
            <label class="mb-4" for="imagen"> Agregar imagen </label>
            <input type="file" name="imagen" class="form-control">
            {* {if $error} 
                <div class="alert alert-danger mt-3">
                    {$error}
                </div>
            {/if} *}
            <div class="d-grid">
                <button type="submit" class="btn btn-primary mt-3">Agregar</button>
            </div>
        </form>
    </div>

{include file='footer.tpl'}