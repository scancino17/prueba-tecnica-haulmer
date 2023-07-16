# Prueba técnica API PHP Haulmer

Desarrollo de prueba técnica para postular a practica en Haulmer. Por Sebastián Cancino, Julio 2023.

# Instrucciones de uso

A continuación se define la configuración realizada para configurar el ambiente de desarrollo. Luego, se hace una breve descripción de la configuración de ejecución. Se termina con las instrucciones para ejecutar el sistema.

## Configuración del ambiente de desarrollo

La solución a esta prueba fue desarrollada en un sistema Windows.

1. Se instaló de forma manual [PHP 8.2.8 NTS](https://windows.php.net/download/).
2. Se configuró PHP activando las extensiones: `php_fileinfo`, `php_zip` y `php_pdo_sqlite`.
3. Se instaló [Composer](https://getcomposer.org/download/) en el sistema. 
4. (Opcional) La instalación de Composer sugiere la instalación de múltiples utilidades, incluyendo Node.js, npm, y herramientas de compilación de Visual Studio 2019.

Es también necesario instalar [Postman](https://www.postman.com/downloads/) en el sistema para ejecutar las pruebas en la API.

## Configuración de ambiente de ejecución

Considerando los alcances y la complejidad de la prueba entregada, se decidió por usar sqlite como base de datos. Esto reduce la cantidad de software requerido para ejecutar la solución y disminuye la cantidad de configuración de entorno de ejecución. 

Para ejecutar el sistema usando sqlite, se debe configurar el fichero `.env`. Aquí se debe reemplazar la línea:

```
DB_CONNECTION = mysql 
```

por

```
DB_CONNECTION = sqlite 
```

y eliminar las siguientes líneas de configuración de base de datos. Si se desea usar otra base de datos que no sea sqlite, se debe hacer en este lugar la configuración adecuada. 

Una vez configurada la base de datos, es posible iniciarla para ser usada en las pruebas. Para esto, se debe ingresar en la carpeta raíz de la solución el comando 

```
> php artisan migrate:fresh --seed
```

Con esto el ambiente de ejecución debería estar listo para el correcto funcionamiento de la solución a la prueba.

## Ejecución de prueba

Para ejecutar la prueba, se utiliza `artisan` para desplegar un servidor de ambiente de desarrollo. En la carpeta raís de la solución se debe ejecutar el comando

```
> php artisan server
```

para desplegar el servidor de depuración. Con la configuración predeterminada el servidor estará disponible en el puerto 8000 de localhost.

En Postman se debe importar la colección incluída en el repositorio. Esta tiene el nombre `coleccion_api.postman_collection.json`. Haciendo click derecho sobre la colección en la lista de la izquierda es posible ejecutar todos los request a la vez, para comprobar resultados.

# Contenido

A continuación se describe de forma general los elementos incluídos en este repositorio.

## Sobre la solución

La solución consta de la gestión de compra de tickets para eventos por parte de los usuarios de la plataforma. Debido a esto, se ha generado una pequeña base de datos con los siguientes modelos:

- El modelo **Customer** representa al usuario en la base de datos. Este contiene información de contacto del usuario y presenta una relación una a muchos con el modelo **Purchase**.
- El modelo **Purchase** es la representación de una compra dentro del sistema. Esto incluye la fecha de creación de la compra, el estado de esta (si esta por pagar, pagada o cancelada), la fecha de pago de la compra y una foreign key al **Customer** al que pertenece. Esto significa que en teoría este objeto no puede existir sin su respectivo **Customer**. Presenta una relación n es a muchos con **Ticket**.
- El modelo **Ticket** es la representación de una entrada dentro del sistema. Este incluye el tipo de entrada, el número de asiento y el código de barra. En teoría este objeto tiene una dependencia a **Event**, ya que no puede existir sin este. También una objeto **Ticket** pertenece a un **Purchase**, pero a pesar de esto un ticket puede todavía no estar comprado, por lo que es válido que este valor sea nulo.
- El modelo **Event** es la representación de un evento dentro del sistema. Se incluye el nombre, la fecha, el lugar y la descripción del evento. Posee una relación uno es a muchos con **Ticket**.

La solución implementa los endpoins `/event/{id}` y `/events` dentro del controlador para eventos (`App\Http\Controllers\EventController`). El endpoint `\purchase` es implementado dentro del controlador para purchases (`App\Http\Controllers\PurchaseController`) y el endpoint `/order` dentro del controlador de usuarios (`App\Http\Controllers\CustomerController`).

La solución implementa lógica adicional para adaptar los nombres de los campos de los modelos de la base de datos a la convención usada en JSON y viceversa. Los campos dentro de la base de datos usan `snake_case` mientras que la convención en JSON es `camelCase`. Esta lógica tambien se encarga de entregar la correcta cantidad de información al momento de listar los eventos. La lógica para adaptar cada modelo puede ser encontrada en `App\Http\Resources`. 

La lógica para gestionar la validación de la entrada de la petición POST se encuentra en `App\Http\Requests\StorePurchaseRequest`. 

La implementación también incluye la definición de la base de datos, la lógica para generar cada modelo y la creación de los elementos con información de muestra en la base de datos. La lógica de cada uno de estos pasos puede ser encontrado por separado en su respectivo migration, factory y seeding, dentro de la carpeta database de la solución.

## Colección de requests en Postman

La colección de requets en Postman es incluída en el fichero `coleccion_api.postman_collection.json` encontrado en la carpeta raíz, junto a este readme. Este debe ser importado a Postman.

La colección de requests en Postman incluye requests que demuestran el funcionamiento de los endpoints:
- Se incluye un caso de demostración del endpoint /events que entrega la lista de eventos y muestra sólamente nombre, fecha y lugar del evento.
- Se incluyen dos casos de demostración del endpoint /event/{id} que entrega en detalle la información de un sólo evento, incluyendo en este caso la descripción de este.
- Se incluyen dos casos de demostración del paso /orders/{id} que entrega una lista que contiene las compras realizadas por el usuario y su ticket correspondiente. 
- Se incluyen 5 casos de demostración del endpoint /purchase/ que crea una nueva compra para un usuario. En tres de estos caso se ingresa un valor erróneo en alguno de los campos a entregar, con el fin de demostrar validación por parte del backend. Uno de estos casos entrega una petición vacia y otro una petición correcta.

## Demostración

A continuación se presenta la demostración del correcto funcionamiento de la solución.
[Link al video](https://alumnosutalca-my.sharepoint.com/:v:/g/personal/scancino17_alumnos_utalca_cl/EaO4dcFQnIhGrkfZtkZf4fsBcbKhtXi6DsbS-N8NPShXHg?e=v1pRse)
![Video insertado](https://alumnosutalca-my.sharepoint.com/:v:/g/personal/scancino17_alumnos_utalca_cl/EaO4dcFQnIhGrkfZtkZf4fsBcbKhtXi6DsbS-N8NPShXHg?e=v1pRse)

# Supuestos y fundamentos

A conitnuación se detallan los alcances definidos de la solución a la prueba, las suposiciones realizadas y su fundamento y formas en que esta prueba podría haber sido mejor ejecutada.

## Alcances y limitaciones

Durante la elaboración de la base de datos, se tomaron un par de decisiones:

- Un usuario podría obtener varios tickets dentro de una sóla compra, por lo que diseñé la base de datos para tener tal relación. Sin embargo, debido a mi conocimiento limitado en el framework, no fui capaz de hacer correctamente esta representación dentro del sistema. La compra de tickets sólo permite la compra de **un** ticket.
- En este mismo punto, al seedear la base de datos se le otorga un sólo ticket a todas las compras. Mi intención original era hacer esto aleatorio, pero me compliqué al momento de asignar las correspondientes foreign keys.
- Una implementación más completa podría haber separado en dos modelos un evento y una instancia de él ocurriendo, como por ejemplo un artista que performa en varias noches. En este caso, decidí no complicar más el modelo y asumir que un evento representa también la instancia en la que ocurre.
- Esta misma idea podría haber sido replicada para tickets y tipos. Por los mismos motivos también se descartó.
- Debido a límite de tiempo asignado a la actividad, no pude implementar la adaptacion a convención en el elemento ticket del elemento purchase del usuario.

También, con el fin de simplificar la actividades de la solución, se asumieron que los siguientes elementos **no** son necesarios.

- Autenticación y validación de usuarios. 
- Paginación.
- Seguridad.
- Endpoints para mostrar o crear elementos que no se pedían en el enunciado.
- Las peticiones de compra reciben su hora de creación y pago dentro del sistema, independiente del estado de la compra. Por lo tanto, para crear una compra sólo se necesita entregar una llave a un usuario y a un ticket existentes; y un estado de compra válido para el sistema (creado, pagado, cancelado).
- Se asume que los tickets son generados junto con el evento, y que estos pertencen a ellos. Hubiese sido más sencillo crear un ticket nuevo para un evento, pero no tiene demasiado sentido. Un evento tiene entradas limitadas.

## Posibles mejoras

Ya que este readme es lo casi lo último que se elabora, ya tengo más experiencia y otras formas de ver la implementación, por lo que es posible hacer algunas observaciones de que se podría haber hecho distinto o algunos lugares a mejorar.

El seeding de la base de datos fue lo primero que implemente y me faltó experiencia con el framework para hacerlo correctamente. Si tuviera la oportunidad de seguir trabajando en esto, sería lo primero que revisaría. Generar correctamente los usuarios, generar tickets que no han sido comprados y generar compras con varios tickets harían la información más cercana a la realidad.

La compra de tickets es otra cosa que mejoraría. Implementaría la funcionalidad para obtener múltiples tickets en una sóla compra y manejaría de mejor manera la definición de la fecha de compra, ya que en estos momentos es rellenada dentro de la aplicación independiente del estado que posea la compra. 

Al momento de crear una compra, se consulta directamente a los tickets del sistema (no mediante query a la base de dato, si no que a través de la abstracción que ofrece Laravel). Esto claramente rompé encapsulación y separación de responsabilidades, por lo que en caso de refactorizar sería lo primero que cambiaría. Aquí habría que optar por algun patrón de diseño adecuado.

La implementación de paginacion y la filtración de campos serían dos características que optaria a ejecutar si tuviera que extender la solución. Esto quedó fuera debido a alcance y por tiempo.
