<?php 
if(isset($subcategoryList)&&!empty($subcategoryList)){
?>
								<div class="card-header p-b-5 p-t-5">
                                    <h4 class="card-title">Subcategory</h4>
                                </div>
                                <div class="card-body subcategory">
                                			<?php 
                                			foreach($subcategoryList as $row){
                                			?>
                                            <button type="button" class="btn btn-outline-primary waves-effect" value="<?php echo $row->category_id?>"><?php echo $row->name;?></button>
                                            <?php 
                                        	}
                                            ?>
                                </div>
<?php 
}
?>

<script>
	$('.subcategory button').on('click', function(){
        $(this).addClass('active');
        $('.subcategory button').not(this).removeClass('active');

        	var category_id = '';
            var subcategory_id = '';
            var page = '<?php echo $page;?>';
            keysearch = '<?php echo $keysearch?>';
        
            $(".subcategory button").each(function(){ 
                if($(this).hasClass("active")) { 
                    subcategory_id = $(this).attr("value");
                }
            });

            $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('content/loadContentList')?>',
                        data: 'category_id='+category_id+'&subcategory_id='+subcategory_id+'&page='+page+'&keysearch='+keysearch+'',
                        success: function(result) { 
                            $("#_list").html(result); 
                        }
            });
    });
</script>