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

        //$path = base_path('tests/Browser/screenshots/adac-2021-02-17-08');
        $base_path=public_path('screenshot/');
        //rename("user/image1.jpg", "user/del/image1.jpg");

       // $images = glob( $base_path.'/*.{jpeg,gif,png}', GLOB_BRACE);
        $images = array_filter(scandir(public_path('screenshot/')), function($item) {
            return !is_dir(public_path('screenshot/') . $item);
        });
        
        foreach($images as $image)
        {
             rename(public_path('screenshot/').$image, public_path('screenshot/error/').$image);
        }

       

        // $path = base_path('tests/Browser/screenshots/adac-2021-02-17-08');
        // $directories = glob($path . '/*' , GLOB_ONLYDIR);
        //$files = File::files(base_path('tests\Browser\screenshots'));
        //print_r($directories);
        //$images = File::allFiles($directories[0]);
        // print_r($images[0]);
        $images = File::allFiles(public_path('screenshot/adac-2021-02-17-12/Footer'));
        //print_r($images[0]);
        $link = $images[0]->getBasename();
        //$link = $images[0]-> getPathname();
        $pics = array();
        foreach ($images as $image) {
            array_push($pics, $image->getBasename());
        }
        //   @foreach($files as $file)
        //   {{ Storage::url($file) }} - {{ $file->lastModified }} 
        //  @endforeach

        // $url = Storage::url('file.jpg');
        //         print_r($images[0]);
        return view('main', [
            'pics' => $pics
        ]);

        //   $path = base_path('tests/Browser/screenshots/adac-2021-02-17-08');
        //    $images= Storage::files('/screenshot/adac-2021-02-17-12/Footer');
        //     var_dump($images);    
        //     return view('result', ['files' => Storage::files(public_path('screenshot/adac-2021-02-17-12/Footer'))]);


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
            $a_directory = str_replace('C:\xampp\htdocs\adac-b2b\public\screenshot//', '', $a_directory);
            array_push($a_dir, $a_directory);
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


      /**
     *
     * @return Response
     */
    public function zipDownload()
    {
        $zip_file = 'screenshot.zip';
        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        $path = public_path('screenshot/adac-2021-02-17-16/');
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
        foreach ($files as $name => $file)
        {
            // We're skipping all subfolders
            if (!$file->isDir()) {
                $filePath     = $file->getRealPath();
        
                // extracting filename with substr/strlen
                $relativePath = 'screenshots/' . substr($filePath, strlen($path));
        
                $zip->addFile($filePath, $relativePath);
            }
        }
        $zip->close();
        return response()->download($zip_file);
    }
}
