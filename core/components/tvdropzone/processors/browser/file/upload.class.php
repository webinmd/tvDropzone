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

    public function initialize()
    {
        $this->setDefaultProperties(array(
            'source' => 1,
            'path' => false,
        ));
        $this->properties = $this->getProperties();
        return true;
    }



    public function process() 
    {

        //$this->modx->log(1,'Line  --- '.print_r($_FILES, 1));

        if (!$this->getSource()) {
            return $this->failure($this->modx->lexicon('permission_denied'));
        }


        if (count($_FILES) < 1) {
            return $this->failure($this->modx->lexicon('mixedimage.err_file_ns'));
        }


        $TV = $this->modx->getObject('modTemplateVar',$this->getProperty('tvId'));

        if (! $TV instanceof modTemplateVar) {
            return $this->failure($this->modx->lexicon('mixedimage.error_tvid_invalid')."<br />\n[".$this->getProperty('tvId')."]");
        }

        $source = $this->modx->getObject('sources.modMediaSource', $this->getProperty('source'));
        $source->initialize();

        if (!$source->checkPolicy('create')) {
            return $this->failure($this->modx->lexicon('permission_denied'));
        }

        $path = '/';

        $success = $source->uploadObjectsToContainer($path, $_FILES);

        // Check for upload errors
        if (empty($success)) {
            $msg = '';
            $errors = $source->getErrors();
            // Remove 'directory already exists' error
            if (isset($errors['name'])) {
                unset($errors['name']);
            }
            if (count($errors) > 0) {
                foreach ($errors as $k => $msg) {
                    $this->modx->error->addField($k,$msg);
                }
                return $this->failure($msg);
            }
        }

        $fName = array_shift($_FILES);
        $url = $fName['name'];
        $url = preg_replace('/\/{2,}/','/',$url);

        //$this->modx->log(1,'Line  --- '.print_r($url, 1));

        return $this->success(stripslashes($url));

    }


 
}

return 'tvdropzoneBrowserFileUploadProcessor';