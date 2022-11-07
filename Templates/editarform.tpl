{include 'header.tpl'}

<div class="my-5 w-50 mx-auto bg-white py-5 px-5 rounded">
    <h3 class="mb-3"> Formulario para editar </h3>
    <form method="POST" action="editar/{$productos->id_producto}" enctype="multipart/form-data">

        <div class="form-group mb-3">
            <label for="precio "> Precio </label>
            <input value="{$productos->precio}" type="text" required class="form-control" name="precio"
                aria-describedby="emailHelp">
        </div>

        <div class="form-group mb-3">
            <label for="nombre">Nombre </label>
            <input type="text" value="{$productos->nombre}" required class="form-control" name="nombre">
        </div>
        <label for="imagen"> Agregar imagen </label>
        <input type="file" value="{$productos->imagen}" name="imagen" class="form-control">
        <hr>
        <h5> Seleccionar la nueva categoria</h5>
        <select class="form-select" name="categoria">
            {foreach  from= $categorias item=categoria}
                <option value="{$categoria->id}">{$categoria->categoria_fk}</option>
            {/foreach}
        </select>
        <hr>
        <h5> Seleccionar la nueva marca</h5>
        <select name="marca" class="form-select">
            {foreach  from= $marcas item=marca}
                <option value="{$marca->id}">{$marca->marca_fk}</option>
            {/foreach}
        </select>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary mt-3">Editar</button>
        </div>
    </form>
</div>

{include file='footer.tpl'}