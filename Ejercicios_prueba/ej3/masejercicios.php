<!-- 3. Recuento por género

Función: contarPorGenero(PDO $pdo): array
Método: query() + fetchAll(PDO::FETCH_KEY_PAIR). Así obtienes un array ['Novela' => 4, 'Ensayo' => 2, ...].

sql
SELECT genero, COUNT(*) AS total FROM libros GROUP BY genero ORDER BY genero

Pinta: una tabla con dos columnas, género y nº de libros.

4. Libros de un autor

Función: librosDeAutor(PDO $pdo, string $autor): array
Método: prepare() + execute() + fetchAll().

sql
SELECT titulo, anio FROM libros WHERE autor = :autor ORDER BY anio

Página: un formulario GET con un campo de texto autor. Si no hay resultados, muestra “No hay libros de ese autor”. Si el campo llega vacío, no consultes.

5. Buscador por título (LIKE)

Función: buscarPorTitulo(PDO $pdo, string $texto): array
Método: prepare() + execute() + fetchAll().

sql
SELECT id, titulo, autor FROM libros WHERE titulo LIKE :texto ORDER BY titulo

Pista: el comodín % va en el valor que pasas a execute() ('%' . $texto . '%'), no dentro de la SQL.
Pinta: los resultados con el título enlazado a ficha.php?id=....

6. Cambiar el género de un libro

Función: cambiarGenero(PDO $pdo, int $id, string $genero): int, que devuelve rowCount().
Método: prepare() + execute().

sql
UPDATE libros SET genero = :genero WHERE id = :id

Página: formulario POST con id oculto y un <select> con los cinco géneros. Valida que el género sea uno de los válidos.
Mensajes: si rowCount() es 1, “Género actualizado”. Si es 0, “No se ha cambiado nada”.
Trampa: prueba a enviar el mismo género que ya tiene el libro. rowCount() devuelve 0 aunque el libro exista. Piensa por qué antes de cambiar el mensaje.

7. Borrar por ISBN

Función: borrarPorIsbn(PDO $pdo, string $isbn): int, que devuelve rowCount().
Método: prepare() + execute().

sql
DELETE FROM libros WHERE isbn = :isbn

Página: formulario POST con un campo de texto para el ISBN.
Mensajes:

Si rowCount() es 1, “Libro eliminado”.
Si es 0, “No existe ningún libro con ese ISBN”.
Si salta el error 1451, “No se puede borrar: el libro tiene préstamos registrados”. Captura la PDOException y mira $e->errorInfo[1]. -->