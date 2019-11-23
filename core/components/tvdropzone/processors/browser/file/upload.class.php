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

        $context_key = $this->formdata['context_key'];
        $this->source = $TV->getSource($context_key);
        $this->source->initialize();

        if (!$this->source->checkPolicy('create')) {
            return $this->failure($this->modx->lexicon('permission_denied'));
        }

        //$this->modx->log(1,'Line  --- '.print_r($this->getProperties(), 1));




    }




 
}

return 'tvdropzoneBrowserFileUploadProcessor';