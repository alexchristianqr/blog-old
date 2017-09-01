<?php
/**
 * Created by PhpStorm.
 * User: aquispe
 * Date: 04/08/2017
 * Time: 05:45 PM
 */

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Border;
use PHPExcel_Style_Fill;

$carbon = (new Carbon());
define('CARBON', $carbon);
define('FECHA_DEFAULT_FORMAT', 'Y-m-d');
define('FECHA', $carbon->format(FECHA_DEFAULT_FORMAT));
define('FECHA_HORA', $carbon->now()->format(FECHA_DEFAULT_FORMAT . ' H:i:s'));
define('FECHA_DETALLE', $carbon->now()->format('Ymd') . '_' . $carbon->now()->format('His'));
define('FECHA_1MES', $carbon->now()->addMonth(1)->format(FECHA_DEFAULT_FORMAT));

trait Utility
{

    public $rpta = [], $service, $ajax, $appkey, $request,
        $textAlignHCenter = ['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER]],
        $textAlignVCenter = ['alignment' => ['horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER]],
        $textAlignHRight = ['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT]],
        $textAlignHLeft = ['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT]],
        $borderAllBordersTHIN = ['borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN]]],
        $borderOutlineTHIN = ['borders' => ['outline' => ['style' => PHPExcel_Style_Border::BORDER_THIN]]],
        $colorFillBlueSOLID = ['fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => ['rgb' => '2196F3']]],
        $colorFillGreenSOLID = ['fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => ['rgb' => '4caf50']]],
        $colorFillTealSOLID = ['fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => ['rgb' => '009688']]],
        $colorFillGreySOLID = ['fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => ['rgb' => '9e9e9e']]],
        $colorFillBlueGreySOLID = ['fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => ['rgb' => '607d8b']]],
        $colorFillYellowSOLID = ['fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => ['rgb' => 'ffeb3b']]],
        $colorFillAmberSOLID = ['fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => ['rgb' => 'ffc107']]],
        $colorFillOrangeSOLID = ['fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => ['rgb' => 'ff9800']]],
        $colorFillIndigoSOLID = ['fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => ['rgb' => '3f51b5']]],
        $colorFillRedSOLID = ['fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => ['rgb' => 'f44336']]],
        $colorFillNoneSOLID = ['fill' => ['type' => PHPExcel_Style_Fill::FILL_NONE]],
        $textDefaultBOLD = ['font' => ['bold' => true, 'color' => ['rgb' => '000000']]],
        $textWhiteBOLD = ['font' => ['bold' => true, 'color' => ['rgb' => 'ffffff']]],
        $textWhite = ['font' => ['bold' => false, 'color' => ['rgb' => 'ffffff']]],
        $textBlack = ['font' => ['bold' => false, 'color' => ['rgb' => '000000']]],
        $textGrey = ['font' => ['bold' => false, 'color' => ['rgb' => '9e9e9e']]];

    //metodo generico que intercede para el catch y prepara la respuesta generica.
    function fnException($exception = null, $title = 'ADVERTENCIA', $level = 'warning')
    {
        if (!is_null($exception)) {
            if ($exception->getCode() > 0) {// PDOException
                $this->rpta = ['load' => false, 'data' => null, 'message' => $exception->getPrevious()->errorInfo[2], 'title' => $title, 'level' => $level];
            } else {// Exception
                $this->rpta = ['load' => false, 'data' => null, 'message' => $exception->getMessage(), 'title' => $title, 'level' => $level];
            }
        }
        self::fnDoLog('E', $exception);
    }

    //metodo generico que ingresa en la respuesta generica para notificar mensaje personalizado de Error.
    function fnError($error = null, $title = 'ERROR', $message = 'contácte al administrador', $level = 'warning')
    {
        if (!is_null($error)) {
            $this->rpta = ['load' => false, 'data' => null, 'detail' => $error, 'title' => $title, 'message' => $message, 'level' => $level];
        }
        self::fnDoLog('E', $error);
    }

    //metodo generico que realiza la respuesta generica de satisfaccion.
    function fnSuccess($data = null, $message = 'ejecutado correctamente', $title = 'BIEN', $level = 'success')
    {
        $this->rpta = ['load' => true, 'data' => $data, 'title' => $title, 'message' => $message, 'level' => $level];
        self::fnDoLog('I', $message);
    }

    //metodo generico que realiza la respuesta.
    function fnFlashMessage($title = 'BIEN', $message = 'ejecutado correctamente', $level = 'success')
    {
        $arr_message = ['title' => $title, 'message' => $message];
        $notifier = app('flash');
        if (!is_null($message)) {
            $notifier->message($arr_message, $level);
        }
        return $notifier;
    }

    //metodo generico que realiza la creacion de una hoja EXCEL
    protected function fnCreateExcel($objPHPExcel, $headers, $columns, $title, $row = 1, $merge = false)
    {
        $objPHPExcel
            ->getProperties()
            ->setCreator('aquispe.developer@gmail.com')
            ->setTitle($title);

        $objPHPExcel->setActiveSheetIndex(0);
        $worksheet = $objPHPExcel->getActiveSheet();
        $total = count($columns);

        for ($i = 0; $i < $total; $i++) {
            if ($merge) {
                if (is_array($columns[$i])) {
                    $foo = $columns[$i][0] . $row . ':' . $columns[$i][1] . $row;
                    $worksheet->mergeCells($foo);
                    $worksheet->setCellValue($columns[$i][0] . $row, $headers[$i]);
                } else {
                    $worksheet->getColumnDimension($columns[$i])->setAutoSize(true);
                    $worksheet->setCellValue($columns[$i] . $row, $headers[$i]);
                }
            } else {
                $worksheet->getColumnDimension($columns[$i])->setAutoSize(true);
                $worksheet->setCellValue($columns[$i] . $row, $headers[$i]);
            }
        }

        if (is_array($columns[$total - 1])) {
            $oneColumn = $columns[$total - 1][1];
        } else {
            $oneColumn = $columns[$total - 1];
        }

        // Dejar estatico solo la primera fila
        $worksheet->freezePane('A' . ($row + 1));
        $styleArray = array(
            'font' => array(
                'bold' => true
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
            )
        );
        $worksheet->getStyle($columns[0] . $row . ':' . $oneColumn . $row)->applyFromArray($styleArray);
        return $worksheet;
    }

    protected function fnGeneratePDF($dompdf, $viewHtml, $config = null)
    {
        if (is_null($config)) {
            $config = [
                'attachment' => '0',
                'hoja' => 'A4',
                'filename' => 'test.pdf',
                'orientation' => 'P',
            ];
        }
        $dompdf->loadHtml($viewHtml->render());
        $dompdf->setPaper($config['hoja'], $config['orientation'] == 'P' ? 'portrait' : 'landscape');
        $dompdf->render();
        $dompdf->stream($config['filename'], ['Attachment' => $config['attachment']]);
    }

    protected function fnSaveImage($path, $request)
    {
        $image = Image::make($request);
        $image->save($path . FECHA_DETALLE . '_' . $request->getClientOriginalName());
    }

    private static function fnDoLog($type, $message)
    {
        // Stream Handlers
        $bubble = false;
        $monolog = new Logger('LOG');//titulo de level log

        $logFormat = "[%datetime%] %level_name%.%channel%: %message%\n";
        $formatter = new LineFormatter($logFormat);

        switch ($type) {
            case 'E'://para errores
                $errorStreamHandler = new StreamHandler(storage_path() . "/logs/laravel_error.log", Logger::ERROR, $bubble);
                $errorStreamHandler->setFormatter($formatter);
                $monolog->pushHandler($errorStreamHandler);
                $monolog->addError($message->getMessage() . ' | ' . $message->getFile() . ' | ' . $message->getLine());
                break;
            case 'I'://para informacion
                $infoStreamHandler = new StreamHandler(storage_path() . "/logs/laravel_info.log", Logger::INFO, $bubble);
                $infoStreamHandler->setFormatter($formatter);
                $monolog->pushHandler($infoStreamHandler);
                $monolog->addInfo($message);
                break;
            default://para lo demas
                $warningStreamHandler = new StreamHandler(storage_path() . "/logs/laravel_warning.log", Logger::WARNING, $bubble);
                $warningStreamHandler->setFormatter($formatter);
                $monolog->pushHandler($warningStreamHandler);
                $monolog->addWarning($message->getMessage());
                break;
        }
    }

    function fnGetAutoIncrement($table, $field = 'id')
    {
        $maxID = DB::table($table)->max($field);
        return (int)$maxID + 1;
    }

}