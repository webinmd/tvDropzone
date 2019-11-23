<input type="hidden" id="tv{$tv->id}" name="tv{$tv->id}" value="{$tv->value|escape}" /> 

<form class="dropzone tv-dropzone" id="tvdropzone{$tv->id}" action="{$assets}connector.php?HTTP_MODAUTH={$token}">
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

    	Dropzone.autoDiscover = false;


    	tvdropzone{$tv->id} = MODx.load({
            source: {$tv->source}
            ,tvId: {$tv->id}
        });


 	});
  
	//]]>
</script>
