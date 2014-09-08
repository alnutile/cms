<?php

use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;

class FilesController extends BaseController {

    public $finder;
    public $filesystem;
    public function __construct(Finder $finder = null, Filesystem $filesystem = null)
    {
        $this->finder           = ($finder == null) ? new Finder() : $finder;
        $this->filesystem       = ($filesystem == null) ? new Filesystem() : $filesystem;
    }

    public function postImage()
    {
        $rel = '/assets/img/wysiwyg';
        $dir = public_path() . $rel;
        $_FILES['upload']['type'] = strtolower($_FILES['upload']['type']);
        if ($_FILES['upload']['type'] == 'image/png'
            || $_FILES['upload']['type'] == 'image/jpg'
            || $_FILES['upload']['type'] == 'image/gif'
            || $_FILES['upload']['type'] == 'image/jpeg')
        {
            $tmp = $_FILES['upload']['tmp_name'];
            $dest = $dir . '/' . $_FILES['upload']['name'];
            $this->filesystem->copy($tmp, $dest, $override = TRUE);
            $array = array(
                'filelink' => '/assets/img/wysiwyg/'.$_FILES['upload']['name']
            );
            $image = '/assets/img/wysiwyg/'.$_FILES['upload']['name'];
        }
        $funcNum = $_GET['CKEditorFuncNum'] ;
        $message = "Image uploaded";
        $script = "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction(\"$funcNum\", \"$image\", \"$message\");</script>";
        return $script;
    }

    public function postFile()
    {
        $rel = '/assets/files/wysiwyg';
        $dir = public_path() . $rel;
        $_FILES['upload']['type'] = strtolower($_FILES['upload']['type']);
        if ($_FILES['upload']['type'] == 'application/pdf'
            || $_FILES['upload']['type'] == 'image/jpg'
            || $_FILES['upload']['type'] == 'image/gif'
            || $_FILES['upload']['type'] == 'image/jpeg'
            || $_FILES['upload']['type'] == 'application/doc')
        {
            $tmp = $_FILES['upload']['tmp_name'];
            $dest = $dir . '/' . $_FILES['upload']['name'];
            $this->filesystem->copy($tmp, $dest, $override = TRUE);

            $file = '/assets/files/wysiwyg/'.$_FILES['upload']['name'];
        }
        $funcNum = $_GET['CKEditorFuncNum'];
        $message = "File uploaded";
        $script = "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction(\"$funcNum\", \"$file\", \"$message\");</script>";
        return $script;
    }

    public function getImageswysiwyg()
    {
        $rel = '/assets/img/wysiwyg';
        $dir = public_path() . '/assets/img/wysiwyg';
        $iterator = $this->finder->in($dir)->name('*.png')->name('*.jpg');
        $files = [];
        $count = 0;
        foreach($iterator as $file) {
            $files[$count]['thumb'] = $rel . '/' . $file->getFilename();
            $files[$count]['image'] = $rel . '/' . $file->getFilename();
            $files[$count]['title'] = $file->getFilename();
            $count ++;
        }
        return Response::json($files);
    }

    public function getFiles()
    {
        $funcNum = $_GET['CKEditorFuncNum'];
        $message = "File chosen";
        $script = "
        <script type='text/javascript' src='/assets/js/jquery.1.10.2.min.js'></script>
        <script type='text/javascript'>
            var sendLink = function(event, url) {
                    event.preventDefault();
                    window.opener.CKEDITOR.tools.callFunction(\"$funcNum\", url, \"$message\");
                    window.close();
                };
                </script>";

        $rel = '/assets/files/wysiwyg';
        $dir = public_path() . '/assets/files/wysiwyg/';
        $iterator = $this->finder->in($dir)->name('*.pdf')->name('*.doc');
        $files = [];
        $count = 0;
        foreach($iterator as $file) {
            $f = $rel . '/' . $file->getFileName();
            $name = $file->getFileName();
            $files[$count]['name'] = "<a href='" . $f . "' onclick='sendLink(event, \"$f\")'>{$name}</a>";
            $files[$count]['choose'] = "<a href='" . $f . "' onclick='sendLink(event, \"$f\")'><i class='glyphicon glyphicon-new-window'></i></a>";
            $count++;
        }

        return View::make('files.index', compact('files', 'script'));
    }
}