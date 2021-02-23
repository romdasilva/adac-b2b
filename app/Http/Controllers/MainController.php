<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use File;
use Illuminate\Support\Facades\Storage;
use Redirect;

class MainController extends BaseController
{
    /**
     *
     * @return Response
     */
    public function show()
    {
       // $images = glob( $base_path.'/*.{jpeg,gif,png}', GLOB_BRACE);
        $error_files = array_filter(scandir(public_path('screenshot/')), function($item) {
            return !is_dir(public_path('screenshot/') . $item);
        });
        
        foreach($error_files as $error_file)
        {
             rename(public_path('screenshot/').$error_file, public_path('screenshot/error/').$error_file);
        }

    }

    public function result(Request $request)
    {
        $action = $request->input('action');
        $screenshot_id = $request->input('screenshot_id');
        if ($action == 'download') {
            $zip_file = 'screenshot.zip';
            $zip = new \ZipArchive();
            $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
            $path = public_path('screenshot/' . $screenshot_id . '/');
            $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
            foreach ($files as $name => $file) {
                // We're skipping all subfolders
                if (!$file->isDir()) {
                    $filePath = $file->getRealPath();

                    // extracting filename with substr/strlen
                    $relativePath = $screenshot_id . '/' . substr($filePath, strlen($path));

                    $zip->addFile($filePath, $relativePath);
                }
            }
            $zip->close();
            return response()->download($zip_file);
        } else {
        //    $images = File::allFiles(public_path('screenshot/' . $screenshot_id . '/' . $action));
            $path = public_path('screenshot/' . $screenshot_id . '/' . $action);
            if(file_exists($path))
            {
            $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
            $pics = array();
            foreach ($files as $name => $file) {
                // We're skipping all subfolders
                if (!$file->isDir()) {
                    $filePath    = $file->getPathname();
                    $relativePath =  substr($filePath, strlen($path) + 1);
                    array_push($pics, $screenshot_id . '/' . $action . '/' . $relativePath);
                }
            }
            return view('result', [
                'pics' => $pics
            ]);
        }
        return Redirect::back()->withErrors(['msg', 'Unfortunately file is not exist']);
        }
    }

    /**
     *
     * @return Response
     */
    public function homePage()
    {
        $a_path = public_path('screenshot/');
        $a_directories = glob($a_path . '/*', GLOB_ONLYDIR);
        $a_dir = array();

        foreach ($a_directories as $a_directory) {
           // $a_directory = str_replace('C:\xampp\htdocs\adac-b2b\public\screenshot//', '', $a_directory);
            $a_directory = substr($a_directory, strlen($a_path));
            array_push($a_dir,str_replace('/','',$a_directory));
        }
        
        $path = public_path('screenshot/'.end($a_dir));
        $directories = glob($path . '/*', GLOB_ONLYDIR);

        $dir = array();
        foreach ($directories as $directory) {
            $teile = explode("/", $directory);
            array_push($dir, end($teile));
        }
  
        return view('home', [
            'dirs' => $dir,
            'screenshots' => $a_dir
        ]);
    }
}
