<?php
require 'fpdf.php';
require '../config/conexao.php';



$sql = "SELECT * FROM livros";
$result = $conexao->query($sql);


$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);


$pdf->Cell(0, 10, 'Lista de Livros', 0, 1, 'C');
$pdf->Ln(5);

$pdf->SetFont('Arial', '', 12);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

       
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, utf8_decode($row['titulo']), 0, 1);

        
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 8, 'Autor: ' . utf8_decode($row['autor']), 0, 1);

        
        $pdf->Cell(0, 8, 'Ano: ' . $row['ano_publicacao'], 0, 1);
 
        
        $pdf->Cell(0, 8, 'Genero: ' . utf8_decode($row['genero']), 0, 1);

       $pdf->Cell(0, 8, 'Quantidade: ' . $row['quantidade'], 0, 1);

        
        $pdf->MultiCell(0, 8, 'Descricao: ' . utf8_decode($row['descricao']));

        
        $pdf->Ln(3);
        $pdf->Cell(0, 0, str_repeat('_', 80), 0, 1);
        $pdf->Ln(5);
    }
} else {
    $pdf->Cell(0, 10, 'Nenhum livro encontrado.', 0, 1);
}


$pdf->Output('D', 'livros.pdf');
?>
