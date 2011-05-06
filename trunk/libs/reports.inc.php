<?php
include_once 'PHPExcel.php';
include_once 'PHPExcel/IOFactory.php';

//create_excel_2003_report()
//$data - double array - data values
//$filename - string - name of the file to create
//prompts to save an excel 2003 report.
function create_excel_2003_report($data,$filename) {
	$excel_file = create_generic_excel($data);
	header('Content-Type: application/vnd.ms-excel');
	header("Content-Disposition: attachment;filename=" . $filename);
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	$writer = PHPExcel_IOFactory::createWriter($excel_file,'Excel5');
	$writer->save('php://output');

}

//create_excel_2007_report()
//$data - double array - data values
//$filename = string - name of the file to create
//prompts to save an excel 2007 report.
function create_excel_2007_report($data,$filename) {

	$excel_file = create_generic_excel($data);
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header("Content-Disposition: attachment;filename=" . $filename);
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	$writer = PHPExcel_IOFactory::createWriter($excel_file,'Excel2007');
	$writer->save('php://output');

}

//create_generic_excel()
//$data - double array - data values
//returns a PHPExcel object with data in correct columns and rows.
//this function is used with create_excel_2007_report and create_excel_2003_report functions
//to reuse common code.
function create_generic_excel($data) {

	$excel_file = new PHPExcel();
	$excel_file->setActiveSheetIndex(0);
	$headings = array_keys($data[0]);
	for ($i=0;$i<count($headings);$i++) {
		$excel_file->getActiveSheet()->setCellValueByColumnAndRow($i,1,$headings[$i]);
		$excel_file->getActiveSheet()->getStyleByColumnAndRow($i,1)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$excel_file->getActiveSheet()->getStyleByColumnAndRow($i,1)->getFont()->setBold(true);
		$excel_file->getActiveSheet()->getStyleByColumnAndRow($i,1)->getFont()->setUnderline(PHPExcel_STYLE_Font::UNDERLINE_SINGLE);
		$excel_file->getActiveSheet()->getColumnDimensionByColumn($i)->setAutoSize(true);
	}
	$rows = count($data);
	$row = 3;
	foreach ($data as $row_data) {
		$column=0;
		foreach ($row_data as $key => $value) {
			$excel_file->getActiveSheet()->setCellValueByColumnAndRow($column,$row,$value);
			if ($key == 'Cost') {
				$excel_file->getActiveSheet()->getStyleByColumnAndRow($column,$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
			}
			else {
				$excel_file->getActiveSheet()->getStyleByColumnAndRow($column,$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
				$excel_file->getActiveSheet()->getStyleByColumnAndRow($column,$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			}
			$column++;
		}
		$row++;
	}

	$excel_file->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
	$excel_file->getActiveSheet()->getPageSetup()->setFitToPage(true);

	return $excel_file;

}

//create_csv_report()
//$data - double array of data
//$filename - name of file to create
//creates a csv file with data and prompts you to save it.
function create_csv_report($data,$filename) {
	$delimiter = ",";
	$file_link = sys_get_temp_dir() . "/" . $filename;
	@unlink($file_link);
	$file_handle = fopen($file_link,"x");
	$headings = array_keys($data[0]);
	fputcsv($file_handle,$headings,$delimiter);
	for ($i=0;$i<count($data);$i++) {
		$row = array_values($data[$i]);
		fputcsv($file_handle,$row,$delimiter);
	}
	fclose($file_handle);
	//Sets headers then downloads the csv report file.
	header('Pragma: public');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Content-Type: application/vnd.ms-excel');
	header("Content-Disposition:attachment; filename=" . $filename);
	readfile($file_link);
	unlink($file_link);

}

//get_filename()
//$month - string - month of report
//$year - string - year of report
//$ext - string - file extension
//returns name of the file based on month, year, and extension.
function get_filename($month,$year,$ext) {
	return "PosterReport-" . $month . "-" . $year . "." . $ext;
}

//sys_get_temp_dir()
//If PHP version < 5.2.1 then this function is needed.
//From http://php.net/manual/en/function.sys-get-temp-dir.php
if ( !function_exists('sys_get_temp_dir')) {
	function sys_get_temp_dir() {
		if (!empty($_ENV['TMP'])) { return realpath($_ENV['TMP']); }
		if (!empty($_ENV['TMPDIR'])) { return realpath( $_ENV['TMPDIR']); }
		if (!empty($_ENV['TEMP'])) { return realpath( $_ENV['TEMP']); }
		$tempfile=tempnam(uniqid(rand(),TRUE),'');
		if (file_exists($tempfile)) {
			unlink($tempfile);
			return realpath(dirname($tempfile));
		}
	}
}


?>
