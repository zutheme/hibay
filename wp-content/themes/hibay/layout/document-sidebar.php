<?php 
$current_language = pll_current_language('slug');
$doc = get_field('doc_'.$current_language,'customizer'); 
?>
<ul class="categories-list clearfix">
<?php
if(isset($doc)){
	foreach($doc as $row) { ?>
		<li><a target="_blank" href="<?php echo $row['doc_url_'.$current_language]; ?>" download><img src="<?php echo $row['doc_image_'.$current_language]['url']; ?>">&nbsp;<?php echo $row['doc_name_'.$current_language]; ?></a></li>
	  <?php 
	}
 } ?>
 <ul>
			