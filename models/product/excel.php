<?php

$val = product_valuation();
if($val === false){
    $excel = new COM("Excel.Application");
    $excel->Visible = 1;
    $excel->DisplayAlerts = 1;
    $workbook = $excel->Workbooks->Add();
    $sheet = $workbook->Worksheets('Sheet1');
    $sheet->activate;

    $polje = $sheet->Range("A1");
    $polje->activate;
    $polje->value = "Error";
}else{
    $excel = new COM("Excel.Application");
    $excel->Visible = 1;
    $excel->DisplayAlerts = 1;
    $workbook = $excel->Workbooks->Add();
    $sheet = $workbook->Worksheets('Sheet1');
    $sheet->activate;

    $br = 1;
    foreach($val as $row){
        $polje = $sheet->Range("A{$br}");
        $polje->activate;
        $polje->value = $val->product;

        // U B kolonu upisujemo TITLE
        $polje = $sheet->Range("B{$br}");
        $polje->activate;
        $polje->value = $val->category;

        // U C kolonu upisujemo DESCRIPTION
        $polje = $sheet->Range("C{$br}");
        $polje->activate;
        $polje->value = $val->quantity;

        // U D kolonu upisujemo TRAILER
        $polje = $sheet->Range("D{$br}");
        $polje->activate;
        $polje->value = $val->value;

        $br++;
    }

    $workbook->Save();
}


header("Location: http://" . BASE_HREF . "/admin");