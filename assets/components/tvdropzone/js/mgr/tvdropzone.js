tvdropzone = {};

tvdropzone.panel = function(config) {
    config = config || {};

    if (!config.source) {config.source = MODx.config.default_media_source;}
    if (!config.ctx) {config.ctx = 'web';}

    Ext.apply(config,{
        border:false
        ,listeners: {}
        ,items:[{
            xtype: 'container' 
            ,layout: 'column'
            ,border: false   
            ,width: '98%' 
            ,id: 'tvdropzone_container'+config.tvId
            ,anchorSize: {width:'98%', height:'auto'}
            ,items: this.getItems(config)
        }]
    });

    tvdropzone.panel.superclass.constructor.call(this,config);
    
    Ext.onReady(function(){this.loadFileForm();},this);
    
    this.on('onFileUploadSuccess',this.onFileUploadSuccess,this);
};
 


//////////////////////////////////////////////////////////
  