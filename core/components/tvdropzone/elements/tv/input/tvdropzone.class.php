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

		}


		public function getLexiconTopics()
        {
			return array('tvdropzone:default');
		}

	}

}

return 'tvDropzoneInputRender';