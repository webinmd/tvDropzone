<?php


class tvdropzoneBrowserFileGetProcessor extends modBrowserFileGetProcessor
{


    public function process()
    {

        /* format filename */
        $loaded = $this->getSource();
        if ($loaded !== true) {
            return $loaded;
        }

        $fileArray = $this->source->getObjectContents('uploads/');


        $this->modx->log(1,'Line  --- '.print_r($fileArray, 1));
        /*
        if (empty($fileArray)) {
            $msg = '';
            $errors = $this->source->getErrors();
            foreach ($errors as $k => $msg) {
                $this->addFieldError($k,$msg);
            }
            return $this->failure($msg);
        }
        return $this->success('',$fileArray);
        */
    }






}

return 'tvdropzoneBrowserFileGetProcessor';
