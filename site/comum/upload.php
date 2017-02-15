<?php
    $dir_upload  = "posts_imgs/";
    $arquivo  = $dir_upload  . basename($_FILES["inputFoto"]["name"]);
    $uploadOk = 1;
    $tipo_arquivo  = pathinfo($arquivo ,PATHINFO_EXTENSION);
    $novo_arquivo = $dir_upload . md5(basename($_FILES["inputFoto"]["name"])) . '.' . $tipo_arquivo;
    $relative_path = __DIR__ . '/../' . $novo_arquivo;

    //Verifica se o arquivo é uma imagem
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["inputFoto"]["tmp_name"]);
        if($check !== false) {
            echo "O arquivo é uma imagem - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "O arquivo 'não é uma imagem.";
            $uploadOk = 0;
        }
    }
    
    // Verifica o tamanho do arquivo
    if ($_FILES["inputFoto"]["size"] > 1000000) {
        echo "Arquivo excede o tamanho máximo.";
        $uploadOk = 0;
    }

    // Permite apenas os formatos JPG, GIF e PNG
    if($tipo_arquivo  != "jpg" && $tipo_arquivo  != "png" && $tipo_arquivo  != "jpeg" && $tipo_arquivo  != "gif" ) {
        echo "Somente arquivos do tipo JPG, JPEG, PNG e GIF são permitidos.";
        $uploadOk = 0;
    }
    
    // Verifica se não houve erros
    if ($uploadOk == 0) {
        echo "O arquivo não foi recebido.";
    // Caso não haja erros, tenta realizar o upload do arquivo
    } else {
        if (move_uploaded_file($_FILES["inputFoto"]["tmp_name"], $relative_path)) {
            echo "O arquivo ". basename( $_FILES["inputFoto"]["name"]). " has been uploaded.";
        } else {
            echo "Ocorreu um erro no upload do seu arquivo. Tente novamente.";
        }
    }
?>