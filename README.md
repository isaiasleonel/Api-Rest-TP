# TP-Web2 APIR REST FULL

## Login

Para los metodos DELETE, POST y PUT se nesecitara estar logueado

```http
  GET http://localhost/TP-Api/auth/token
```

Ingresar la siguiente cuenta :

| Email           | Password |
| :-------------- | :------- |
| leo@exactas.com | 23456    |

# API Request

## METODO GET

#### Get all

Para obtener todo el Json

```http
  GET http://localhost/TP-Api/api/productos
```

## Para obtener por ID

```http
  GET http://localhost/TP-Api/api/productos/2
```

| Parameter | Type     |
| :-------- | :------- |
| `id`      | `number` |

## Paginacion

Se debera ingresar los parametros y por defecto mostrara 10 productos.

```http
  GET http://localhost/TP-Api/api/productos?page=2
```

| Parameter | Type     | Description   |
| :-------- | :------- | :------------ |
| `page`    | `number` | ?page= numero |

## Filtrar

Se debera ingresa 2 parametros:

column -> colocamos el nombre de la columna

value -> colocamos el nombre o numero a buscar de la columna seleccionada

| Parameter | Type     | Description                     |
| :-------- | :------- | :------------------------------ |
| `column`  | `string` | column = "nombre de la columna" |

| Parameter | Type               | Description                        |
| :-------- | :----------------- | :--------------------------------- |
| `value`   | `string or number` | value = "nombre o numero a buscar" |

Quedando la url de esta forma :

```http
  GET http://localhost/TP-Api/api/productos?column=id_producto&value=2

```

## Ordenar

Colocamos 2 parametros :

sortby -> colocamos el nombre de la columna a ordenar

order -> "asc" ascendente o "desc" descendente

| Parameter | Type     | Description                   |
| :-------- | :------- | :---------------------------- |
| `sortby`  | `string` | sortby="nombre de la columna" |

| Parameter | Type      | Description          |
| :-------- | :-------- | :------------------- |
| `order`   | `string ` | order = "asc o desc" |

Quedando de la siguiente forma :

```http
  GET http://localhost/TP-Api/api/productos?sortby=nombre&order=asc

```

_Detalle de esta URL : Si se ingresa un parametro lanzara por defecto :_

- Si solo se agrega el sortby lo pondra al orden en "asc".

- Si solo se agrega el order , entonces el sortby eligira la columna id_producto para su ordenamiento.

## METODO POST

Antes que nada debera loguearse([cuenta de prueba](##Login)) para este metodo, asi poder agregar un nuevo dato(JSON).

```http
  POST http://localhost/TP-Api/api/productos
```

###### Ejemplo del Json body

```json
{
  "id_producto": 2,
  "precio": 50000,
  "nombre": "RX 570 8GB GDDR5 Phantom Gaming Elite",
  "imagen": "img/634dc96f2847d.jpg",
  "marca_fk": "ASROCK",
  "categoria_fk": "Placa de Video"
}
```

## Detalles

La marca_fk es clave foranea se debera elegir estas marcas colocandolo en " STRING " :

| ID  | Nombre de marcas |
| :-- | :--------------- |
| 1   | ASUS             |
| 2   | MSI              |
| 3   | ASROCK           |
| 4   | ZOTAC            |
| 5   | GALAX            |
| 6   | GEIL             |
| 7   | ADATA            |
| 8   | KINGSTON         |
| 9   | PATRIOT          |

La categoria_fk tambien es una clave foranea se debera elegir de esta listas colocandolo en "STRING" :

| ID  | Nombre de categorias |
| :-- | :------------------- |
| 1   | Procesador           |
| 2   | Placa de Video       |

## METODO PUT

Tambien debera loguearse([cuenta de prueba](##Login)) para este metodo, asi poder editar la infomacion(JSON).

```http
  PUT http://localhost/TP-Api/api/productos/56
```

###### Ejemplo del Json body

```json
{
  "id_producto": 2,
  "precio": 50000,
  "nombre": "RX 570 8GB GDDR5 Phantom Gaming Elite",
  "imagen": "img/634dc96f2847d.jpg",
  "marca_fk": "ASROCK",
  "categoria_fk": "Placa de Video"
}
```

| Parameter | Type     | Description           |
| :-------- | :------- | :-------------------- |
| `id`      | `number` | **Se requiere el Id** |

### ⚠ A tener en cuanta las claves foraneas que van segun [listado de la seccion Detalles](##Detalles).

## METODO DELETE

Tambien debera loguearse([cuenta de prueba](##Login)) para este metodo, asi poder editar la infomacion(JSON).

```http
  DELETE http://localhost/TP-Api/api/productos/56
```

## Authors

- [@Isaias Leonel Sardina](https://github.com/isaiasleonel)
