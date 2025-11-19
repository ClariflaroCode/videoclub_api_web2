**ENTRAR EN MODO EDITAR PARA QUE SE VEA BIEN EL README**

API RESTFUL de un catálogo de películas creada con PHP y MySQL para la materia de Web 2. 

La API permite:

- Listar películas con ordenamiento, filtrado y paginación.
- Obtener una película por su ID.
- Agregar nuevas películas.
- Modificar películas existentes.
- Eliminar películas.

Las operaciones de escritura (`POST`, `PUT`, `DELETE`) están protegidas mediante **autenticación JWT**.

**Endpoints:**

| Método | Endpoint  | Descripción | Requiere token | Ejemplo |

|  GET | /peliculas  | Lista todas las películas (con filtros, orden y paginación) | ❌ | GET /peliculas?sort=precio&order=DESC&page=1&limit=5 |
|  GET | /peliculas/:id | Obtiene una película específica | ❌ | GET /peliculas/3
|  POST| /peliculas | Agrega una nueva película | ✅ |  POST /peliculas
|  PUT | /peliculas/:id | Edita una película existente | ✅ | PUT /peliculas/5
| DELETE | /peliculas/:id | Elimina una película | ✅ | DELETE /peliculas/2

**Parámetros opcionales (query):**

| Parámetro | Descripción | Ejemplo |
|------------|--------------|----------|
| sort | Campo por el que se ordena | sort=precio |
| order | Dirección (ASC o DESC) | order=DESC |
| page | Número de página  | page=1 |
| limit | Cantidad de resultados por página | limit=5 |
| *(cualquier campo de la tabla)* | Filtrado exacto por valor | genero=Acción |

