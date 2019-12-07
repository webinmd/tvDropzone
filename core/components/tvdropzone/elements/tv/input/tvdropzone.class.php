<?php
if (!class_exists('tvDropzoneInputRender')) {

	class tvDropzoneInputRender extends modTemplateVarInputRender
    {

		public function getTemplate() {
			return $this->modx->getOption('core_path').'components/tvdropzone/elements/tv/input/tpl/tvdropzone.tpl';
		}


		public function process($value,array $params = array())
        {

			$this->setPlaceholder('assets',$this->modx->getOption('assets_url').'components/tvdropzone/');
            $this->setPlaceholder('token', $this->modx->user->getUserToken($this->modx->context->get('key')));

            $this->modx->lexicon->load('tvdropzone');
            $this->setPlaceholder('empty_text', $this->modx->lexicon('tvdropzone.empty_text'));

            $context = ($this->modx->resource->get('context_key')) ? $this->modx->resource->get('context_key') : 'web';

            $this->source = $this->tv->getSource($context);
            $source_properties = $this->source->getPropertyList();

            if(($source_properties['basePath'] != '')){
                $basePath = $source_properties['basePath'];
            }  else {
                $basePath = '';
            }

            $this->setPlaceholder('basePath', $basePath);

            //$source = $this->tv->source;
            //$source_properties = $source->getPropertyList();

            //$this->modx->log(1,'Line  --- '.print_r($source_properties, 1));

		}


		public function getLexiconTopics()
        {
			return array('tvdropzone:default');
		}

	}

}

return 'tvDropzoneInputRender';