{include 'header.tpl'}

<div class="mt-5 w-50 mx-auto mb-5">
    <form class="py-5 px-5 bg-white" method="POST" action="agregarcategoria">

        <label for="nombre">Nombre de la nueva categoria</label>
        <input type="text" required class="form-control" name="nombreCat">
        <div class="d-grid">
            <button type="submit" class="btn btn-primary mt-4 ">Agregar</button>
        </div>
    </form>
</div>

{include file='footer.tpl'}