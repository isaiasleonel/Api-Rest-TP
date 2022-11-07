<!----------- contenedor de botones de Productos ------------->
<h2> Tabla de producto</h2>
<div class="contenedor-btnAdm d-flex my-2">
    <div class="  dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categorias
        </button>
        <ul class="dropdown-menu">
            {foreach  from= $categorias item=value}
                <li>
                    <a class="dropdown-item" href="ordenamiento/{$value->id}"> {$value->categoria_fk}</a>
                </li>
            {/foreach}

        </ul>
    </div>
    <a type="button" class="btn btn-info" href="inicio">Mostrar todo</a>
    <a type="button" class="btn btn-primary" href="agregarform">Agregar</a>
</div>
<!-----------------fin de botoneras------------>

<!------------------- Tabla de productos---------->
<div class="containerTable mb-5 ">
    <h5 class="my-2"> Mostrando <strong>{$count}</strong> productos</h5>
    <table class="table bg-white rounded">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Precio</th>
                <th scope="col">Nombre</th>
                <th scope="col">Categoria</th>
                <th scope="col">Marca</th>
                <th scope="col">Imagen</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$productos item=newBD}
                <tr>
                    <th scope="row">{$newBD->id_producto}</th>
                    <td>${$newBD->precio}</td>
                    <td>{$newBD->nombre}</td>
                    <td>{$newBD->categoria_fk}</td>
                    <td>{$newBD->marca_fk}</td>
                    <td><img src="{$newBD->imagen}" width="50"></td>
                    <td><a href="editarform/{$newBD->id_producto}" class="btn btn-warning" type="button">Editar</a></td>
                    <td><a href="eliminar/{$newBD->id_producto}" type="button" class="btn btn-danger">Eliminar</a>
                    </td>
                </tr>
            {{/foreach}}
        </tbody>
    </table>

    <!----------------------- Fin tabla de producto----------------------->

    <div class="mt-5 w-50 mx-auto bg-white py-5 px-5 rounded">

        <!---------------Formulario para editar Categoria ------->
        <form method="POST" action="editarcategoria">
            <div>
                <h5> Editar nueva categoria</h5>
                <!------------------ Select de Categorias--------------->
                <select class="form-select mb-3" name="categoria">
                    {foreach  from= $categorias item=categoria}
                        <option value="{$categoria->id}">{$categoria->categoria_fk}</option>
                    {/foreach}
                </select>

                <input placeholder="Nombre" type="text" name="name" required class="form-control">
            </div>
            <div>
                <button type="submit" class="btn btn-warning mt-4">Editar</button>
            </div>
        </form>
        <hr>
        <div class="mt-4">
            <h5> Agregar categoria</h5>
            <a type="button" class="btn btn-primary" href="agregarformCategoria">Agregar Categoria</a>
        </div>
        <hr>
        <!---------------Formulario para eliminar Categoria------->
        <form class="mt-4" action="eliminarcategoria" method="POST">
            <h5> Eliminar categoria</h5>
            <select class="form-select mb-3" name="categoria">
                {foreach  from= $categorias item=categoria}
                    <option value="{$categoria->id}">{$categoria->categoria_fk}</option>
                {/foreach}
            </select>
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
        <hr>
    </div>

    <!------------------ Fin de tabla de categorias ------------>
</div>