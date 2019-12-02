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

    	Dropzone.autoDiscover = false;
        var tvropzone{$tv->id} = new Dropzone("#tvdropzone{$tv->id}", {
            url: connector_url,
            addRemoveLinks: true,
            init: function(){

                if (valObject != '') {

                    var myDropzone = this;
                    var files = JSON.parse(valObject);

                    for (var i = 0, len = Object.keys(files).length; i < len; i++) {
                        var mockFile = { name: files[i].name, size: files[i].size };
                        myDropzone.emit("addedfile", mockFile);
                        myDropzone.emit("thumbnail", mockFile, '/uploads/'+files[i].name);
                        myDropzone.emit("complete", mockFile);
                    }

                }

            },
            removedfile: function(file) {
                var name = file.name;
                console.log(name);

                Ext.Ajax.request ({
                    url: connector_url,
                    params: {
                        action: 'removefile',
                        file: name,
                        source: {$tv->source},
                    },
                    success: function(response) {
                        file.previewElement.remove();
                    }
                });
            }
        });


        tvropzone{$tv->id}.on("queuecomplete", function(file, res) {

            if(valObject != '') {
                var count = Object.keys({$tv->value}).length;
                var val = JSON.parse(JSON.stringify({$tv->value}));
            } else {
                var count = 0;
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
        });


 	});
  
	//]]>
</script>
