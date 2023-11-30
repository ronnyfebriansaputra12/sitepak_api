<script language="javascript">	
	var opsi_wilayah=(<?=json_encode($opsi)?>);	
	$(function(){		
		SettingWilayah(opsi_wilayah,'<?=$url?>');		
	});
</script>