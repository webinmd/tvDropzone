<input type="hidden" id="tv{$tv->id}" name="tv{$tv->id}" value="{$tv->value|escape}" />

<form class="tv-dropzone" id="tvdropzone{$tv->id}" action="{$assets}connector.php?HTTP_MODAUTH={$token}">
    <input type="hidden" name="action" value="browser/file/upload" />
    <input type="hidden" name="source" value="{$tv->source}" />
    <input type="hidden" name="tvId" value="{$tv->id}" />
    <div class="fallback">
        <input type="file" name="file" />
    </div>
    <div class="dz-message" data-dz-message><span>{$empty_text}</span></div>
</form> 

<script>
	//<![CDATA[
 
    Ext.onReady(function()   {

        let connector_url = "{$assets}connector.php?HTTP_MODAUTH={$token}";
        var valObject = '{$tv->value}' || '';

        if (valObject != '') {
            var files = JSON.parse(valObject);
            var count = Object.keys(files).length;
        } else{
            var count = 0;
        }


    	Dropzone.autoDiscover = false;
        var tvropzone{$tv->id} = new Dropzone("#tvdropzone{$tv->id}", {
            url: connector_url,
            addRemoveLinks: true,
            init: function(){

                if (count > 0) {

                    var myDropzone = this;

                    for (var i = 0, len = count; i < len; i++) {
                        var mockFile = { name: files[i].name, size: files[i].size };
                        myDropzone.emit("addedfile", mockFile);
                        myDropzone.emit("thumbnail", mockFile, '/{$basePath}'+files[i].name);
                        myDropzone.emit("complete", mockFile);
                    }

                }

            },
            removedfile: function(file) {

                var name = file.name;

                Ext.Ajax.request ({
                    url: connector_url,
                    params: {
                        action: 'removefile',
                        file: name,
                        source: {$tv->source},
                    },
                    success: function(response) {

                        //console.log(valObject);

                        var files = JSON.parse(valObject);
                        var res = {};
                        var j = 0;

                        for (let i = 0; i < Object.keys(files).length; ++i) {
                            if( files[i].name != file.name ) {
                                res[j++] = {
                                    name: files[i].name,
                                    size: files[i].size,
                                    type: files[i].type
                                }
                            }
                        }

                        if(Object.keys(res).length > 0) {
                            document.getElementById('tv{$tv->id}').value = JSON.stringify(res);
                        } else {
                            document.getElementById('tv{$tv->id}').value = '';
                        }


                        file.previewElement.remove();

                        var currentCount = document.querySelectorAll('#tvdropzone{$tv->id} .dz-preview').length;
                        var $elem = document.getElementById("tvdropzone{$tv->id}").getElementsByClassName("dz-message")[0];

                        if(currentCount>0) {
                            $elem.style.display = "none";
                        } else {
                            $elem.style.display = "block";
                        }

                        MODx.fireResourceFormChange();
                    }
                });

            }
        });


        tvropzone{$tv->id}.on("queuecomplete", function(file, res) {

            if(count>0) {
                var val = JSON.parse(JSON.stringify({$tv->value}));
            } else {
                var val = {};
            }

            for (let i = 0; i < tvropzone{$tv->id}.files.length; ++i) {
                val[count++] = {
                    name: tvropzone{$tv->id}.files[i].upload.filename,
                    size: tvropzone{$tv->id}.files[i].size,
                    type: tvropzone{$tv->id}.files[i].type
                }
            }
            document.getElementById('tv{$tv->id}').value = JSON.stringify(val);
            MODx.fireResourceFormChange();
        });


 	});
  
	//]]>
</script>
