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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Border;
use PHPExcel_Style_Fill;

$carbon = (new Carbon());
define('FECHA_DEFAULT_FORMAT', 'Y-m-d');
define('FECHA', $carbon->format(FECHA_DEFAULT_FORMAT));
define('FECHA_HORA', $carbon->now()->format(FECHA_DEFAULT_FORMAT . ' H:i:s'));
define('FECHA_DETALLE', $carbon->now()->format('YmdHis'));
define('FECHA_1MES', $carbon->now()->addMonth(1)->format(FECHA_DEFAULT_FORMAT));
define('DIR_IMG_USERS', asset('images/users') . '/');

define('PATH_POSTS', public_path() . '/images/posts/');
define('PATH_USERS', public_path() . '/images/users/');

define('ASSET_POSTS', asset('/images/posts') . '/');
define('ASSET_USERS', asset('/images/users') . '/');
define('ASSET_APP', asset('/images/app') . '/');

trait Utility
{
    //variables Respuesta y de uso para los estilos de Excel.
    public $rpta = [], $service, $appkey,
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
    function fnException($exception = null, $title = 'my exception', $level = 'warning')
    {
        if (!is_null($exception)) {
            if ($exception->getCode() > 0) {//is PDOException
                $this->rpta = ['load' => false, 'title' => $title, 'message' => $exception->getMessage(), 'level' => $level];
            } else {//is Exception
                $this->rpta = ['load' => false, 'title' => $title, 'message' => $exception->getMessage(), 'level' => $level];
            }
            $this->fnDoLog('E', $this->rpta['message']);
        }
    }

    //metodo generico que ingresa en la respuesta generica para notificar mensaje personalizado de Error.
    function fnError($message = null, $title = 'my error', $level = 'danger')
    {
        if (!is_null($message)) {//is Error
            $this->rpta = ['load' => false, 'title' => $title, 'message' => $message, 'level' => $level];
            $this->fnDoLog('E', $this->rpta['message']);
        }
    }

    //metodo generico que realiza la respuesta generica de satisfaccion.
    function fnSuccess($data = null, $message = 'execute successfully', $title = 'very good', $level = 'success')
    {
        if (!is_null($data)) {//is Notify
            $this->rpta = ['load' => true, 'data' => $data, 'title' => $title, 'message' => $message, 'level' => $level];
            $this->fnDoLog('I', $message);
        }
    }

    //metodo generico que realiza la respuesta.
    public function fnFlashMessage($title = 'very good', $message = 'execute successfully', $level = 'success')
    {
        $arr_message = ['title' => $title, 'message' => $message];
        $notifier = app('flash');
        if (!is_null($message)) {
            $notifier->message($arr_message, $level);
        }
        return $notifier;
    }

    //metodo generico para crear y exportar EXCEL.
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

    //metodo generico para crear y exportar PDF.
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

    //metodo generico para guardar una imagen en el servidor.
    protected function fnSaveImage($path, $request, $filename)
    {
        $image = Image::make($request);
        $image->save(public_path() . $path . FECHA_DETALLE . '_' . $filename);
        return FECHA_DETALLE . '_' . $filename;
    }

    function fnImage($type, $request, $filename)
    {
        $image = Image::make($request);
        $path = public_path() . '/images/app/';
        if ($type == 'save') {
            $image->save($path . FECHA_DETALLE . '_' . $filename);
            return FECHA_DETALLE . '_' . $filename;
        }
        if ($type == 'delete') {
            return File::delete(public_path() . $path . $request);
        }


    }

    //metodo generico para crear un archivo log y para trazar la informacion.
    private static function fnDoLog($type, $message)
    {
        // Stream Handlers
        $bubble = false;
        $monolog = new Logger('LOG');//titulo de level log

        $logFormat = "[%datetime%] %level_name%.%channel%: %message%\n";
        $formatter = new LineFormatter($logFormat);

        switch ($type) {
            case 'E'://Exception/Error
                $errorStreamHandler = new StreamHandler(storage_path() . "/logs/laravel_error.log", Logger::ERROR, $bubble);
                $errorStreamHandler->setFormatter($formatter);
                $monolog->pushHandler($errorStreamHandler);
                $monolog->addError(is_string($message) ? $message : $message->getMessage() . ' | ' . $message->getFile() . ' | ' . $message->getLine());
                break;
            default://Info
                $infoStreamHandler = new StreamHandler(storage_path() . "/logs/laravel_info.log", Logger::INFO, $bubble);
                $infoStreamHandler->setFormatter($formatter);
                $monolog->pushHandler($infoStreamHandler);
                $monolog->addInfo($message);
                break;
        }
    }

    //metodo generico que devuelve el Max Id Autoincrementado de una tabla de la base de datos.
    function fnGetAutoIncrement($table, $field = 'id')
    {
        $maxID = DB::table($table)->max($field);
        return (int)$maxID + 1;
    }

    function fnSendMail($view, $request, $func)
    {
        Mail::send($view, ['remember_token' => $request->remember_token], $func);
        /*
        $message->sender($address, $name = null);
        $message->to($address, $name = null);
        $message->cc($address, $name = null);
        $message->bcc($address, $name = null);
        $message->replyTo($address, $name = null);
        $message->subject($subject);
        $message->priority($level);
        $message->attach($pathToFile, array $options = []);
        // Attach a file from a raw $data string...
        $message->attachData($data, $name, array $options = []);
        // Get the underlying SwiftMailer message instance...
        $message->getSwiftMessage();
        */

    }

    function getTable($table, $oneWhere = null, $join = null)
    {
        if (is_array($oneWhere)) {
            return DB::table($table)->where($oneWhere[0], $oneWhere[1])->get();
        }
        if (is_array($join)) {
            return DB::table($table)
                ->join($join['table'], $join['first'], $join['ope'], $join['second'])
                ->distinct()
                ->get();
        }
        return DB::table($table)->get();
    }
}