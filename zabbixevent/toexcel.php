<?php
include 'lib/PHPExcel.php';
include 'conn.php';
//include 'lib/PHPExcel/IOFactory.php';
//include 'lib/PHPExcel/Writer/Excel2007.php';

$objPHPExcel = new PHPExcel(); 
// Set the active Excel worksheet to sheet 0
$objPHPExcel->setActiveSheetIndex(0); 
$objPHPExcel->getActiveSheet()->setCellValue('A1', '主机名')
                              ->setCellValue('B1', '触发ID')
                              ->setCellValue('C1', '描述信息')
                              ->setCellValue('D1', '时间');

$sql="select host,triggerid,description,value,time from newevent 
where description like '%磁盘%' and value=1 
and eventid in (select max(eventid) from newevent  group by triggerid )";

$q=$mysqli->query($sql);

$rowCount=2;
while($row=$q->fetch_assoc()){ 
    //print_r($row);
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$rowCount, $row['host']);
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $row['triggerid']); 
    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $row['description']); 
    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $row['time']); 

    $rowCount++; 
}

//$q->close();
$q->free();
$mysqli->close();

//标题填充
$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);  
$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFill()->getStartColor()->setARGB('00ffff00');

//Set column widths 设置列宽度  
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);  
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10); 
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);  
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20); 


/*
// Instantiate a Writer to create an OfficeOpenXML Excel .xlsx file
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
// Write the Excel file to filename some_excel_file.xlsx in the current directory
$objWriter->save('some_excel_file.xlsx'); 
*/


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="disk.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 2016 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>
