<?php
$corePath = $modx->getOption('core_path',null,MODX_CORE_PATH).'components/tvdropzone/';
$assetsUrl = $modx->getOption('assets_url',null,MODX_ASSETS_URL).'components/tvdropzone/';

$modx->lexicon->load('tvdropzone:default');

switch ($modx->event->name) {
    case 'OnTVInputRenderList':
        $modx->event->output($corePath.'elements/tv/input/');
        break;
    case 'OnTVOutputRenderList':
        $modx->event->output($corePath.'elements/tv/output/');
        break;
    case 'OnTVInputPropertiesList':
        $modx->event->output($corePath.'elements/tv/input/options/');
        break;
    case 'OnTVOutputRenderPropertiesList':
        $modx->event->output($corePath.'elements/tv/properties/');
        break;
    case 'OnDocFormPrerender': 
        $modx->regClientStartupScript($assetsUrl.'js/mgr/lib/dropzone.js');
        $modx->regClientStartupScript($assetsUrl.'js/mgr/tvdropzone.js');
        $modx->regClientCSS($assetsUrl.'js/mgr/lib/dropzone.css');
        $modx->regClientCSS($assetsUrl.'css/mgr/tvdropzone.css');
        $modx->controller->addLexiconTopic('tvdropzone:default');
        break;
    case 'OnMODXInit':
    case 'OnLoadWebDocument':
        $mTypes = $modx->getOption('manipulatable_url_tv_output_types',null,'image,file').',tvdropzone';
        $modx->setOption('manipulatable_url_tv_output_types', $mTypes);
        break;
}