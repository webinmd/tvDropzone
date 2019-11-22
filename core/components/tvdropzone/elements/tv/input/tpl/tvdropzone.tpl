<input type="hidden" id="tv{$tv->id}" name="tv{$tv->id}" value="{$tv->value|escape}" /> 

<form class="dropzone {$assetsPath}" id="tvdropzone{$tv->id}" action="../assets/components/tvdropzone/connector.php">
    <input type="hidden" name="action" value="browser/file/upload" />
    <div class="fallback">
        <input type="file" name="file" />
    </div>
</form> 

<script>
	//<![CDATA[
 
    Ext.onReady(function()   {    
    	Dropzone.autoDiscover = false;
        var tvId = "#tvdropzone" +"{$tv->id}";     
 	});
  
	//]]>
</script>
