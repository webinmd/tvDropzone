<?php
/**
 * Upload files to a directory
 *
 * @param string $path The target directory
 *
 * @package tvdropzone
 * @subpackage processors.browser.file
 */

class tvdropzoneBrowserFileUploadProcessor extends modBrowserFileUploadProcessor 
{
 
    public function checkPermissions() 
    {

        return true;

        $this->modx->log(1,'Source  --- ');
        return $this->modx->hasPermission('file_upload');
    }


    public function initialize() 
    {
        $this->setProperties(array("path" => '/uploads/'));
        if (!$this->getSource()) {
         return $this->modx->lexicon('permission_denied');
        }
        $this->source->setRequestProperties($this->getProperties());
        $this->source->initialize();
        if (!$this->source->checkPolicy('create')) {
         return $this->modx->lexicon('permission_denied');
        }
        return parent::initialize();
    }

/*
    public function process() 
    {
        return $this->success();

        if (!$this->getSource()) {
            return $this->failure('Hello');
            //return $this->failure($this->modx->lexicon('permission_denied'));
        }
         
        //return $this->success(stripslashes($url));
    }

    public function getLanguageTopics() 
    {
        $langs = parent::getLanguageTopics();
        $langs[] = 'tvdropzone';
        return $langs;
    }
    */


 
}

return 'tvdropzoneBrowserFileUploadProcessor';