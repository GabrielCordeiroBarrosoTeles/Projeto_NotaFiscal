<?php
    header('Content-Type: text/html; charset=utf-8');
    require('fpdf/fpdf.php');

    // Verificar se o parâmetro 'arquivo' está presente na URL
    if (isset($_GET['arquivo'])) {
        $arquivo = $_GET['arquivo'];

         // Verificar se o arquivo existe
        if (file_exists($arquivo)) {

            // Ler o conteúdo do arquivo XML
            $xml = file_get_contents($arquivo);
            $traco='------------------------------------------------------------------------------------------';
            // Criar um objeto FPDF com suporte UTF-8
            class PDF extends FPDF {
                function Header() {
                    $this->SetFont('Arial', 'B', 29);
                    $this->SetXY($this->GetX(), $this->GetY() -7);
                    $this->Cell(190, 10, utf8_decode('Company Name'), 0, 1, 'C');
                    $this->SetFont('Arial', '', 18);
                    $this->Cell(190, 10, utf8_decode('(85) 989999999'), 0, 1, 'C');
                    $this->Cell(190, 10, utf8_decode('00.000.000/0001-00'), 0, 1, 'C');
                    $this->Cell(190, 10, utf8_decode('Rua sla, 36 - Fortaleza - CE'), 0, 1, 'C');
                    
                    
                }
            }

            // Adicionar uma página
            $pdf = new PDF();
            $pdf->AddPage();
            $pdf->Image('../img/logo.png', 47, 3, 10);
            // Definir a fonte e o tamanho do texto com suporte UTF-8
            $pdf->SetFont('Arial', '', 18);

            // Largura total da página
            $larguraPaginaTotal = 190; // Lembre-se de ajustar para a largura total da sua página
            // Larguras dos elementos
            $larguraElemento1 = 95;
            $larguraElemento2 = 95; 
            // Cálculo da posição X inicial e final da linha de traço
            $posicaoInicialX = $pdf->GetX() + $larguraElemento1;
            $posicaoFinalX = $posicaoInicialX + $larguraElemento2;
 
            // Move o cursor para a posição X inicial da linha de traço
            $pdf->SetX($posicaoInicialX);
 
            // Adiciona a linha de traço
            $pdf->Cell($larguraElemento2, 0, utf8_decode($traco), 0, 0, 'R');
 
            // Volta o cursor para a posição original após adicionar o traço
            $pdf->SetX($pdf->GetX() - $larguraElemento2);
            $pdf->Cell($larguraElemento1, 0, utf8_decode(' '), 0, 0, 'L'); //NÃO APAGUE!
            $pdf->Cell($larguraElemento2, 0, utf8_decode(""), 0, 1, 'R'); //NÃO APAGUE!

            // Processar o conteúdo XML
            $notaFiscal = simplexml_load_string($xml);
            $numeroNota = (string)$notaFiscal->numero;
            $dataNota = (string)$notaFiscal->data;
            $horaNota = (string)$notaFiscal->hora;
            $formattedDataNota = date('d/m/y', strtotime($dataNota));
            $nomeCliente = (string)$notaFiscal->cliente->nome;
            $cpfCliente = (string)$notaFiscal->cliente->cpf;
            $nomeEmpresa = (string)$notaFiscal->empresa->nome;
            $cnpjEmpresa = (string)$notaFiscal->empresa->cnpj;
            $enderecoEmpresa = (string)$notaFiscal->empresa->endereco;
            $telefoneEmpresa = (string)$notaFiscal->empresa->telefone;
            $valorTotal = (float)$notaFiscal->valor_total;
            $impostoFederal = (float)$notaFiscal->imposto_federal;
            $impostoMunicipal = (float)$notaFiscal->imposto_municipal;
            $totalComImpostos = (float)$notaFiscal->total_com_impostos;
            $forma_de_pagamento = (string)$notaFiscal->forma_de_pagamento;

            // Largura da página (exemplo: 210mm)
            $larguraPagina = 210;

            // Largura dos elementos (ajuste conforme necessário)
            $larguraElemento1 = 95;
            $larguraElemento2 = 95;

            //Adicionar ao PDF
            
            $pdf->Cell(95, 10, utf8_decode('Impresso em:'), 0, 0, 'R');
            $pdf->Cell(95, 10, utf8_decode($formattedDataNota.'  '.$horaNota), 0, 1, 'L');
            $pdf->SetXY($pdf->GetX(), $pdf->GetY() - 2);
            $pdf->Cell(95, 10, utf8_decode('( Número da Nota Fiscal:'), 0, 0, 'R');
            $pdf->Cell(95, 10, utf8_decode($numeroNota.' )'), 0, 1, 'L');


            $pdf->Cell(57.5, 10, utf8_decode('Nome do Produto'), 0, 0, 'C'); // Definir borda como 0
            $pdf->Cell(53.5, 10, utf8_decode('Quantidade'), 0, 0, 'C'); // Definir borda como 0
            $pdf->Cell(43.5, 10, utf8_decode('Preço Unitário'), 0, 0, 'C'); // Definir borda como 0
            $pdf->Cell(43.5, 10, utf8_decode('Subtotal'), 0, 1, 'C'); // Definir borda como 0
            $somaSubtotais = 0; // Variável para armazenar a soma dos subtotais
            
            foreach ($notaFiscal->itens->item as $item) {
                $nomeProduto = (string)$item->nome;
                $quantidade = (string)$item->quantidade;
                $precoUnitario = (float)$item->valor_venda;
                $subtotal = (float)$item->subtotal;

                $pdf->SetXY(7, $pdf->GetY());
                $pdf->Cell(57.5, 10, utf8_decode($nomeProduto), 0, 0, 'C'); // Definir borda como 0
                $pdf->Cell(53.5, 10, utf8_decode($quantidade), 0, 0, 'C'); // Definir borda como 0
                $pdf->Cell(43.5, 10, utf8_decode('R$ ' . number_format($precoUnitario, 2, ',', '.')), 0, 0, 'C'); // Definir borda como 0
                $pdf->Cell(43.5, 10, utf8_decode('R$ ' . number_format($subtotal, 2)), 0, 1, 'C'); // Definir borda como 0
            
                $somaSubtotais += $subtotal; // Atualiza a soma dos subtotais
                $impostoFederal = $somaSubtotais * 0.10; // Exemplo de imposto federal de 10%
                $impostoMunicipal = $somaSubtotais * 0.05; // Exemplo de imposto municipal de 5%
                $somaImpostos = $impostoFederal + $impostoMunicipal; // Calcular a soma dos impostos
                $somaSubtotaisComImpostos = $somaSubtotais + $impostoFederal + $impostoMunicipal; // Calcular a soma dos subtotais com os impostos
            }

            $pdf->SetXY($pdf->GetX(), $pdf->GetY() + 4);   
            // Largura total da página
            $larguraPaginaTotal = 190; // Lembre-se de ajustar para a largura total da sua página

            // Larguras dos elementos
            $larguraElemento1 = 95;
            $larguraElemento2 = 95;

            // Cálculo da posição X inicial e final da linha de traço
            $posicaoInicialX = $pdf->GetX() + $larguraElemento1;
            $posicaoFinalX = $posicaoInicialX + $larguraElemento2;

            // Move o cursor para a posição X inicial da linha de traço
            $pdf->SetX($posicaoInicialX);

            // Adiciona a linha de traço
            $pdf->Cell($larguraElemento2, 0, utf8_decode($traco), 0, 0, 'R');



            $pdf->Cell($larguraElemento1, 0, utf8_decode(' '), 0, 0, 'L'); //NÃO APAGUE!
            $pdf->Cell($larguraElemento2, 0, utf8_decode(""), 0, 1, 'R'); //NÃO APAGUE!
            $pdf->Cell($larguraElemento1, 10, utf8_decode('Forma de Pagamento:'), 0, 0, 'L');
            $pdf->Cell($larguraElemento2, 10, utf8_decode($forma_de_pagamento), 0, 1, 'R');  
            $pdf->Cell($larguraElemento1, 10, utf8_decode('Imposto Federal:'), 0, 0, 'L');
            $pdf->Cell($larguraElemento2, 10, utf8_decode('R$ ' . number_format($impostoFederal, 2)), 0, 1, 'R');  
            $pdf->Cell($larguraElemento1, 10, utf8_decode('Imposto Municipal:'), 0, 0, 'L');
            $pdf->Cell($larguraElemento2, 10, utf8_decode('R$ ' . number_format($impostoMunicipal, 2)), 0, 1, 'R');  
            $pdf->Cell($larguraElemento1, 10, utf8_decode('Soma dos Impostos:'), 0, 0, 'L');
            $pdf->Cell($larguraElemento2, 10, utf8_decode('R$ ' . number_format($somaImpostos, 2)), 0, 1, 'R'); 
            $pdf->Cell($larguraElemento1, 10, utf8_decode('Soma dos Subtotais:'), 0, 0, 'L');
            $pdf->Cell($larguraElemento2, 10, utf8_decode('R$ ' . number_format($somaSubtotais, 2)), 0, 1, 'R');
            $pdf->Cell($larguraElemento1, 10, utf8_decode('Soma dos Subtotais com Imposto:'), 0, 0, 'L');
            $pdf->Cell($larguraElemento2, 10, utf8_decode('R$ ' . number_format($somaSubtotaisComImpostos, 2)), 0, 1, 'R');  

            $pdf->SetXY($pdf->GetX(), $pdf->GetY() +4);
           // Adicionar a soma dos subtotais com os impostos
            $pdf->Cell($larguraElemento1, 10, utf8_decode('Nome do Cliente: '.$nomeCliente), 0, 1, 'L');
            $pdf->SetXY($pdf->GetX(), $pdf->GetY() - 1);   
            // Adicionar a soma dos subtotais com os impostos e quebrar linha
            $pdf->Cell($larguraElemento1, 10, utf8_decode('CPF do Cliente: '.$cpfCliente), 0, 1, 'L');
            // Centralizar "Obrigado pela Preferência!"
            $pdf->Cell(195, 10, utf8_decode('Obrigado pela Preferência!'), 0, 1, 'C'); // O último parâmetro é 1 para quebrar a linha

            // Calcular a posição Y para centralizar "Volte Sempre!"
            $altura_celula = 10;
            $altura_texto = 5;
            $y = $pdf->GetY() + ($altura_celula - $altura_texto) / 2;

            $pdf->SetXY($pdf->GetX(), $y);
            $pdf->Cell(195, 10, utf8_decode('Volte Sempre!'), 0, 0, 'C');
 
            // Gerar o PDF e enviar para o navegador
            $pdf->Output();
            exit;
        } else {
            echo 'Arquivo não encontrado.';
        }
    } else {
        echo 'Parâmetro "arquivo" não especificado.';
    }
?>