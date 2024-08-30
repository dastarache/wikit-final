<?php
    $n_nombre = $_REQUEST['n_nombre'];
    $n_curso = $_REQUEST['n_curso'];
    $perfil = $_REQUEST['perfil'];
    $valor = $_REQUEST['precio'];
    $fecha = $_REQUEST['fecha'];
    // include class
    
    require "../assets/fpdf/fpdf.php";

    require "../assets/plugin/code128.php";

    
    $pdf = new PDF_Code128('P','mm',array(100,258));
    $pdf->AddPage();
    
    # Encabezado y datos de la empresa #
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(0,5,utf8_decode(strtoupper("WIKIT")),0,'C',false);
    $pdf->SetFont('Arial','',9);
    $pdf->MultiCell(0,5,utf8_decode("Curso: $n_curso"),0,'C',false);


    $pdf->Ln(1);
    $pdf->Cell(0,5,utf8_decode("------------------------------------------------------"),0,0,'C');
    $pdf->Ln(5);

    $pdf->MultiCell(0,5,utf8_decode("Fecha: $fecha"),0,'C',false);
    $pdf->MultiCell(0,5,utf8_decode("Nombre: $n_nombre"),0,'C',false);
    $pdf->SetFont('Arial','B',10);

    $pdf->Ln(1);
    $pdf->Cell(0,5,utf8_decode("-------------------------------------------------------------------"),0,0,'C');
    $pdf->Ln(3);

    # Tabla de productos #
    $pdf->Cell(35,5,utf8_decode("curso"),0,0,'C');
    $pdf->Cell(15,5,utf8_decode("Cant"),0,0,'C');
    $pdf->Cell(10,5,utf8_decode("Precio"),0,0,'C');

    $pdf->Ln(3);
    $pdf->Cell(72,5,utf8_decode("-------------------------------------------------------------------"),0,0,'C');
    $pdf->Ln(3);



    /*----------  Detalles de la tabla  ----------*/

    

    $pdf->Cell(35,4,($n_curso),0,0,'C');
    $pdf->Cell(15,4,("1"),0,0,'C');
    $pdf->Cell(10,4,($valor),0,0,'C');
    $pdf->Ln(3);
    $pdf->Cell(72,5,utf8_decode("-------------------------------------------------------------------"),0,0,'C');
    $pdf->Ln(3);



    $pdf->Ln(7);
    /*----------  Fin Detalles de la tabla  ----------*/


    # Impuestos & totales #}
    $pdf->Cell(18,5,utf8_decode(""),0,0,'C');
    $pdf->Cell(22,5,utf8_decode("SUBTOTAL"),0,0,'C');
    $pdf->Cell(32,5,utf8_decode("+ $valor"),0,0,'C');


    $pdf->Ln(5);

    $pdf->Cell(72,5,utf8_decode("-------------------------------------------------------------------"),0,0,'C');

    $pdf->Ln(5);

    $pdf->Cell(18,5,utf8_decode(""),0,0,'C');
    $pdf->Cell(22,5,utf8_decode("TOTAL A PAGAR"),0,0,'C');
    $pdf->Cell(32,5,utf8_decode("$valor"),0,0,'C');


    $pdf->Ln(10);

    $pdf->MultiCell(0,5,utf8_decode("*** NO SE REALIZAN DEVOLUCIONES :V ***"),0,'C',false);

    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(0,7,utf8_decode("Gracias por su compra"),'',0,'C');

    $pdf->Ln(9);


    $pdf->AddPage();


   // config document
   $pdf->SetTitle('CERTIFICAD');
   $pdf->SetAuthor('WIKIT');
   $pdf->SetCreator('FPDF WIKIT');

   // add title
   $pdf->SetFont('Arial', 'B', 23);
   $pdf->Cell(0, 13, '     CERTIFICADO     ', 0, 1);
   $pdf->Ln();

   // add text
   $pdf->SetFont('Arial', '', 10);
   $pdf->MultiCell(0, 7, utf8_decode('Se certifica que: '.$n_nombre.''), 0, 1);
   $pdf->Ln();
   $pdf->MultiCell(0, 7, utf8_decode('ha completado satisfactoriamente el curso : '.$n_curso.''), 0, 1);
   $pdf->Ln();
   $pdf->MultiCell(0, 7, utf8_decode('otorgado por: WIKIT'), 0, 1);
   $pdf->Ln();

   // add image
   $pdf->Image('../assets/img/'.$perfil.'', null, null, 80);






    // output file
    $pdf->Output('', 'fpdf-complete.pdf');

?>