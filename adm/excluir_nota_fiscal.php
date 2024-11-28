<?php
if(isset($_GET['arquivo'])){
    $arquivo = urldecode($_GET['arquivo']);
    
    if(file_exists($arquivo)){
        unlink($arquivo);
        echo "Nota fiscal excluída com sucesso.";
        header("Location: exibir_notasfiscais.php"); // Redireciona para exibir_notasfiscais.php
        exit; // Encerra o script para evitar que o restante do código seja executado
    } else {
        echo "Erro ao excluir a nota fiscal: arquivo não encontrado.";
    }
} else {
    echo "Erro ao excluir a nota fiscal: arquivo não especificado.";
}
?>
