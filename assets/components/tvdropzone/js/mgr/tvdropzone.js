tvdropzone = {};

tvdropzone.panel = function(config) {
    config = config || {};

    if (!config.source) {config.source = MODx.config.default_media_source;}
    if (!config.ctx) {config.ctx = 'web';}

    //console.log(config);

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

Ext.extend(tvdropzone.panel,Ext.Container,{
    getItems:function(config){
        return [this.getImageContainer(config)];
    }
    ,getImageContainer:function(config){
        return{
            xtype:'container'
            ,hidden: true
            ,id: 'tvdropzone_media_container'+config.tvId
            ,items: [{
                xtype:'modx-combo-browser'
                ,browserEl: 'modx-browser'
                ,TV: this
                ,id: 'tvdropzone_media'+config.tvId
                ,source: config.source
                ,ctx_path: config.ctx_path
                ,openTo: config.openPath
                ,listeners: {
                    'select':{fn:this.onBrowserSelect,scope:this}
                }
            }]
        };
    }
    ,onFileUploadSuccess:function(r){

    }
    ,setValue:function(value){
        this.getInput().setValue(value);
        this.getTVField().dom.value = value;
        this.el.dom.value = value;
        MODx.fireResourceFormChange();
    }
    ,getInput:function(){
        this.input = this.input||Ext.getCmp('tvdropzone_input'+this.tvId);
        return this.input;
    }
    ,getTVField:function(){
        this.tvfield = this.tvfield||Ext.get('tv'+this.tvId);
        return this.tvfield;
    }
});
Ext.reg('tvdropzone-panel',tvdropzone.panel); 