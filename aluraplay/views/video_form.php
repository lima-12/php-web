<?php

$this->layout('layout');

?>

<main class="container">

    <form class="container__formulario" method="post" enctype="multipart/form-data">

        <h2 class="formulario__titulo">Envie um vídeo!</h2>
        
            <div class="formulario__campo">
                <label class="campo__etiqueta" for="url">Link embed</label>
                <input value="<?=$video?->url;?>" name="url" class="campo__escrita" id='url' placeholder="Por exemplo: https://www.youtube.com/embed/FAY1K2aUg5g" required />
            </div>


            <div class="formulario__campo">
                <label class="campo__etiqueta" for="titulo">Titulo do vídeo</label>
                <input value="<?=$video?->title;?>" name="titulo" class="campo__escrita" id='titulo' placeholder="Neste campo, dê o nome do vídeo" required />
            </div>

            <div class="formulario__campo">
                <label class="campo__etiqueta" for="image">Imagem do vídeo</label>
                <input type="file" name="image" class="campo__escrita" id='image' accept="image/*" />
            </div>

            <input class="formulario__botao" type="submit" value="Enviar" />
    </form>

</main>
