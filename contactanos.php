<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/contactanos_styles.css">
    <title>Contactanos</title>
</head>
    <!-- Header -->

    <header>
        <?php
        include 'header.php';
        ?>
    </header>

    <!-- Contactanos -->

<body>
<div class="contact_form">
    <div class="formulario">			
    <h1>Contactanos - Formulario</h1>
    <h3>Envianos un mensaje a nosotros, alguien de nosotros se pondra en contacto con usted, para ello llene los campos siguientes:</h3>
        <form action="submeter-formulario.php" method="post">				
            <p>
                <label for="nombre" class="colocar_nombre">Nombre completo
                <span class="obligatorio">*</span>
                </label>
                <input type="text" name="introducir_nombre" id="nombre" required="obligatorio" placeholder="Escribe tu nombre">
            </p>
            <p>
                <label for="email" class="colocar_email">Correo Electronico
                <span class="obligatorio">*</span>
                </label>
                <input type="email" name="introducir_email" id="email" required="obligatorio" placeholder="Escribe tu Email">
            </p>                
            <p>
                <label for="telefone" class="colocar_telefono">Teléfono
                </label>
                <input type="tel" name="introducir_telefono" id="telefono" placeholder="Escribe tu teléfono">
            </p>		       
            <p>
                <label for="website" class="colocar_website">Sitio web
                </label>
                <input type="url" name="introducir_website" id="website" placeholder="Escribe la URL de tu web">
            </p>		    
            <p>
                <label for="asunto" class="colocar_asunto">Asunto
                <span class="obligatorio">*</span>
                </label>
                <input type="text" name="introducir_asunto" id="assunto" required="obligatorio" placeholder="Escribe un asunto">
            </p>		
            <p>
                <label for="mensaje" class="colocar_mensaje">Mensaje
                <span class="obligatorio">*</span>
                </label>                     
                <textarea name="introducir_mensaje" class="texto_mensaje" id="mensaje" required="obligatorio" placeholder="Deja aquí tu comentario..."></textarea> 
                </p>	  								
                <button type="submit" name="enviar_formulario" id="enviar"><p>Enviar</p></button>
                <p class="aviso">
                <span class="obligatorio"> * </span>LLene los campos que son presentados a continuación aparte que algunos son requeridos forzosamente por lo cual hagalo por favor.
            </p>					
            </form>
        </div>	
    </div>

    <!-- Footer -->

        <?php
    include 'footer.php';
    ?>

</body>
</html>