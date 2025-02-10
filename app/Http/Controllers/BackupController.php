<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    public function index(){
        $backups = Storage::disk('backups')->files();
        // print_r($backups);
        // Transformar los nombres de los archivos en un array estructurado
        $backupData = array_map(function ($file) {
            return [
                'nombre' => basename($file),
                'tamaño' => Storage::disk('backups')->size($file),
                'fecha' => Storage::disk('backups')->lastModified($file),
            ];
        }, $backups);

         // Ordenar los archivos por fecha de modificación (descendente)
        usort($backupData, function ($a, $b) {
            return $b['fecha'] - $a['fecha']; // Orden descendente
        });

        return view('admin.backups.index', compact('backupData'));
    }

    public function create()
    {
        try {
            Log::info('Iniciando creación de backup desde WEB...');
            Artisan::call('backup:run');

            // Capturar la salida del comando
            $output = Artisan::output();
            Log::info('Backup Output: ' . $output);

            return Redirect::route('admin.backups.index')
                ->with('mensaje', 'Backup creado exitosamente.')
                ->with('icono', 'success');
        } catch (\Exception $e) {
            Log::error('Error al crear backup: ' . $e->getMessage());

            return Redirect::route('admin.backups.index')
                ->with('mensaje', 'Error al crear backup: ' . $e->getMessage())
                ->with('icono', 'error');
        }
    }
    // public function create()
    // {
    //     try {
    //         Log::info('Iniciando creación de backup desde WEB (v2 - path debug)...'); // Mensaje modificado

    //         // *** DEPURACIÓN: Registrar dump_binary_path ***
    //         // $dumpBinaryPath = config('backup.backup.database_dumps.mysql.dump_binary_path');
    //         // Log::info('dump_binary_path from config: ' . $dumpBinaryPath);
    //         // *** FIN DE LA SECCIÓN DE DEPURACIÓN ***

    //         Artisan::call('backup:run');

    //         return redirect()->route('admin.backups.index')
    //             ->with('mensaje', 'Backup creado (v2 - path debug): ' ) // Mensaje de éxito modificado
    //             ->with('icono', 'success');
    //     } catch (\Exception $e) {
    //         Log::error('Error Backup (WEB v2 - path debug): ' . $e->getMessage()); // Mensaje de error modificado
    //         return redirect()->route('admin.backups.index')
    //             ->with('mensaje', 'ERROR (v2 - path debug): ' . $e->getMessage()) // Mensaje de error modificado
    //             ->with('icono', 'error');
    //     }
    // }

    // public function create()
    // {
    //     try {
    //         Log::info('Iniciando creación de backup desde WEB...');

    //         // *** AÑADIR ESTO TEMPORALMENTE PARA DEPURACIÓN ***
    //         Log::info('Environment Variables: ' . json_encode($_ENV));
    //         Log::info('Server Variables: ' . json_encode($_SERVER));
    //         // *** FIN DE LA SECCIÓN DE DEPURACIÓN ***


    //         Artisan::call('backup:run');

    //         return redirect()->route('admin.backups.index')
    //             ->with('mensaje', 'Backup creado: ' )
    //             ->with('icono', 'success');

    //     } catch (\Exception $e) {
    //         Log::error('Error Backup (WEB): ' . $e->getMessage());
    //         return redirect()->route('admin.backups.index')
    //             ->with('mensaje', 'ERROR: ' . $e->getMessage())
    //             ->with('icono', 'error');
    //     }
    // }

    // public function create()
    // {
    //     try {
    //         Log::info('Iniciando creación de backup...');

    //         Artisan::call('backup:run');

    //         $output = Artisan::output();
    //         Log::info('Backup Output: ' . $output);

    //         return redirect()->route('admin.backups.index' . $output)
    //                ->with('mensaje', 'Backup creado: ' )
    //                ->with('icono', 'success');

    //     } catch (\Exception $e) {
    //         Log::error('Error Backup: ' . $e->getMessage());
    //         return redirect()->route('admin.backups.index')
    //                ->with('mensaje', 'ERROR: ' . $e->getMessage())
    //                ->with('icono', 'error');
    //     }
    // }


    // public function download($file_name)
    // {
    //     $disk = Storage::disk('backups');
    //     if ($disk->exists($file_name)) {
    //         return Storage::disk('backups')->download($file_name);
    //     }
    //     return redirect()->back()->with('error', 'El archivo no existe.');
    // }

    // public function delete($file_name)
    // {
    //     $disk = Storage::disk('backups');
    //     if ($disk->exists($file_name)) {
    //         $disk->delete($file_name);
    //         return redirect()->back()->with('mensaje', 'Backup eliminado exitosamente.')->with('icono', 'success');
    //     }
    //     return redirect()->back()->with('error', 'El archivo no existe.');
    // }


}
