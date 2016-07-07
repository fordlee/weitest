<?php if (!defined('THINK_PATH')) exit();?><form action="<?php echo U('Upload/upiconfile');?>" name="upfile_form" method="post" enctype="multipart/form-data">
	<input  type="file" name="iconfile" id="iconfile" multiple="" />
	<input type="submit" class="btn btn-minier btn-purple" value="Upload">
</form>