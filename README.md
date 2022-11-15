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

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `number` | **Required**. Id of item to fetch |

## Paginacion

Se debera ingresar los parametros
<br>

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

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `number` | **Required**. Id of item to fetch |

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
| 12  | Memoria RAM          |

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

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `number` | **Required**. Id of item to fetch |

### ⚠ A tener en cuanta las claves foraneas que van segun [este listado](##Detalles).

## METODO DELETE

Tambien debera loguearse([cuenta de prueba](##Login)) para este metodo, asi poder editar la infomacion(JSON).

```http
  DELETE http://localhost/TP-Api/api/productos/56
```

## Authors

- [@Isaias Leonel Sardina](https://github.com/isaiasleonel)
