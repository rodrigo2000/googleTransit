<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

GoogleTransit UI
================

Sistema con interface visual para poder usar generar archivos Data Feed para GoogleTransit.

Este sistema sirve si usted proporciona un servicio de transporte que está abierto al público, y opera con horarios fijos y rutas.

¿Cómo es el proceso sin GoogleTransit UI?
-----------------------------------------

1.  Generar una fuente de datos de acuerdo al <a herf="http://developers.google.com/transit/gtfs/?hl=en">General Transit Feed Specification (GTFS)</a> y al [Documento de Buenas Prácticas]
2.  Validar la alimentación mediante el [Feed Validator].
3.  Inspeccione la alimentación en el [Visor de horarios].
4.  Genera un archivo ZIP y nómbralo como zip google\_transit.zip.
5.  Sube tu archivo a un servidor web para que Google acceder a él. Se acepta HTTP y HTTPS.
6.  Póngase en contacto con el equipo de Google Transit para inscribirse en la asociación.
7.  Google se pondrá en contacto para configurar una vista previa privada y que la agencia complete un acuerdo en línea antes del lanzamiento.
8.  La Agencia Camionera pondrá a prueba los datos en la vista previa privada hasta que el resultado sea satisfactorio.
9.  ¡Lanzamiento en Google Transit!

Todo esto se hace mediante archivos TXT, CSV o en el mejor de los casos, mediante Excel

Ventajas de usar GoogleTransit UI
---------------------------------

Con GoogleTransit UI usted puede guardar la informaciónde forma fácil y sencilla. Incluso podría usar un teléfono celular como GPS para mejorar sus puntos.

GTUI genera el archivo fácil y cómodamente y permite subir de forma rápida a su servidor.

Con GTUI ustede puede usar herramientas de forma visual que le facilitarán la generación de las rutas.

  [Documento de Buenas Prácticas]: http://maps.google.com/help/maps/mapcontent/transit/bestpractices.html
  [Feed Validator]: http://github.com/google/transitfeed/wiki/FeedValidator?hl=en
  [Visor de horarios]: http://github.com/google/transitfeed/wiki/ScheduleViewer?hl=en