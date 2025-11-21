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

Ejemplo para conocer la estructura del body y utilizar en el POST O PUT: 

{
    "titulo": "tiburon",
    "duracion": 120,
    "imagen": "https://www.lascosasquenoshacenfelices.com/wp-content/uploads/2025/06/Tiburon-las-cosas-felices.01-e1749284997448.jpg",
    "precio": 120,
    "descripcion": "Un gigantesco tiburón blanco amenaza a los habitantes y turistas de un pueblo costero. El alcalde encomienda la caza del escualo al jefe de         la policía, un pescador y un científico. El grupo se da cuenta de que es un animal inteligente y violento.",
    "fecha_lanzamiento": "1975-06-20",
    "atp": 0,
    "director_id": 4,
    "genero": "animales",
    "distribuidora": "universal pictures"
    }
