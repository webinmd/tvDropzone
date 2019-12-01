<input type="hidden" id="tv{$tv->id}" name="tv{$tv->id}" value="{$tv->value|escape}" />

<form class="tv-dropzone" id="tvdropzone{$tv->id}" action="{$assets}connector.php?HTTP_MODAUTH={$token}">
    <input type="hidden" name="action" value="browser/file/upload" />
    <input type="hidden" name="source" value="{$tv->source}" />
    <input type="hidden" name="tvId" value="{$tv->id}" />
    <div class="fallback">
        <input type="file" name="file" />
    </div>
</form> 

<script>
	//<![CDATA[
 
    Ext.onReady(function()   {

        let connector_url = "{$assets}connector.php?HTTP_MODAUTH={$token}";

    	Dropzone.autoDiscover = false;
        var tvropzone{$tv->id} = new Dropzone("#tvdropzone{$tv->id}", {
            url: connector_url,
            addRemoveLinks: true,
            init: function(){

                var myDropzone = this;
                var valObject = {$tv->value};

                console.log(Object.keys(valObject).length);

                for (var i = 0, len = Object.keys(valObject).length; i < len; i++) {
                    console.log(valObject[i]);

                    var mockFile = { name: valObject[i] };

                    myDropzone.emit("addedfile", mockFile);
                    myDropzone.emit("thumbnail", mockFile, '/uploads/'+valObject[i]);
                    myDropzone.emit("complete", mockFile);

                }




                /*

                Object.keys(valObject).map(function(value, key) {
                    console.log(value, key);
                });
                */

                /*

                myDropzone = this;
                var data = { 'action': 'getfiles'};

                var params = Object.keys(data).map(
                    function(k){ return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]) }
                ).join('&');

                var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
                xhr.open('POST', connector_url);

                xhr.onreadystatechange = function() {
                    if (xhr.readyState>3 && xhr.status==200) { success(xhr.responseText); }
                };

                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send(params);
                */

                /*
                $.ajax({
                    url: connector_url,
                    type: 'post',
                    data: { 'action': 'getfiles'},
                    dataType: 'json',
                    success: function(response){

                        console.log(response);

                        $.each(response, function(key,value) {
                            var mockFile = { name: value.name, size: value.size };

                            myDropzone.emit("addedfile", mockFile);
                            myDropzone.emit("thumbnail", mockFile, value.path);
                            myDropzone.emit("complete", mockFile);

                        });

                            }
                        });
                */

            }
        });

        tvropzone{$tv->id}.on("queuecomplete", function(file, res) {
            let count = Object.keys({$tv->value}).length;
            let val = {$tv->value} || {};
            for (let i = 0; i < tvropzone{$tv->id}.files.length; ++i) {
                val[count++] = tvropzone{$tv->id}.files[i].upload.filename;
            }
            document.getElementById('tv{$tv->id}').value = JSON.stringify(val);
        });



        /*
    	tvdropzone{$tv->id} = MODx.load({
            xtype: 'tvdropzone-panel'
            source: {$tv->source}
            ,tvId: {$tv->id}
        });
        */

 	});
  
	//]]>
</script>
