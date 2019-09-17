<?php
if(!class_exists('tvDropzoneInputRender')) {
	class tvDropzoneInputRender extends modTemplateVarInputRender {

		public function getTemplate() {
			return $this->modx->getOption('core_path').'components/tvdropzone/elements/tv/input/tpl/tvdropzone.tpl';
		}

		public function process($value,array $params = array()) {
			$this->modx->regClientCSS($this->modx->getOption('assets_url').'components/tvdropzone/css/mgr/tvdropzone.css');
			$this->modx->regClientStartupScript($this->modx->getOption('assets_url').'components/tvdropzone/js/mgr/lib/dropzone.js');
			$this->modx->regClientStartupScript($this->modx->getOption('assets_url').'components/tvdropzone/js/mgr/tvdropzone.js');
			// Set assets path
			$this->setPlaceholder('assets',$this->modx->getOption('assets_url').'components/tvdropzone/');

			$this->modx->lexicon->load('tvdropzone');
 
		}

		public function getLexiconTopics(){
			return array('tvdropzone:default');
		}

	}
}
return 'tvDropzoneInputRender';