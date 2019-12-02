<?php


class tvdropzoneBrowserFileRemoveProcessor extends modBrowserFileRemoveProcessor
{


    public function process11()
    {

        /* format filename */


        //$this->modx->log(1,'Line  --- '.print_r($fileArray, 1));
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

return 'tvdropzoneBrowserFileRemoveProcessor';
