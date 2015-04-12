<div class="row">
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa fa-table fa-fw "></i> 
				Search 
		</h1>
	</div>
</div>

<div class="row">
    <div class="col-sm-2 col-md-2">
        <ul class="nav nav-pills nav-stacked">
            <li class="active">
                <a href="./admin/search?q=<?php echo $q; ?>">
                    Global Search
                    <span class="badge pull-right"><?php echo (int) $count; ?></span>
                </a>
            </li>
            <?php foreach (\Search\Factory::sources() as $source) { ?>
            <li>
                <a href="./admin/search?q=<?php echo $q; ?>&filter[search]=<?php echo $source['id']; ?>">
                    <span class="badge pull-right"><?php echo (int) $counts[$source['title']]; ?></span>
                    <?php echo $source['title']; ?>
                </a>
            </li>
            <?php } ?>
        </ul>
    </div>
    <div class="col-sm-10 col-md-10">

        <div class="row">
            <div class="col-md-12">
                <form method="get" action="./admin/search" role="search">
                    <div class="form-group">
                    <div class="input-group">
                        <input name="q" type="text" class="form-control" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit" tabindex="3">Search</button>
                        </span>
                    </div>
                    </div>
                </form>
            </div>
        </div>
                
         <?php if(!empty($results)) : ?>        
               <?php foreach($results as $type => $items) : ?>     
               	<h2>
               	    <?php echo $type; ?>
               	    <?php if ($count_items = count($items)) { ?>
               	    &nbsp;&nbsp;&ndash;&nbsp;&nbsp;<small>First <?php echo (int) $count_items; ?> of <?php echo $counts[$type]; ?> matches</small>
               	    <?php } ?>
               	</h2>
               		<?php foreach($items as $model_item) : ?>
               		<?php $item = $model_item->toAdminSearchItem();?>
               	
                    <div class="list-group-item">    
                        <div class="row">    
                            <div class="col-xs-3 col-sm-3 col-md-2">
                                <?php if ($item->image) { ?>
                                <a href="<?php echo $item->url; ?>">
                                    <img src="<?php echo $item->image; ?>" class="img-responsive" style="width: 100%;" />
                                </a>
                                <?php } else { ?>
                                <a href="<?php echo $item->url; ?>">
                                    <img src="./AdminTheme/img/placeholder.png" class="img-responsive" style="width: 100%;" />
                                </a>                                
                                <?php } ?>
                            </div>
                            <div class="col-xs-9 col-sm-9 col-md-10">
                                <a href="<?php echo $item->url; ?>">
                                    <h3><?php echo $item->title; ?></h3>
                                </a>
                                <?php if (!empty($item->subtitle)) { ?>
                                <h4><?php echo $item->subtitle; ?></h4>
                                <?php } ?>
                                <?php if (!empty($item->datetime)) { ?>
                                <h5><?php echo $item->datetime; ?></h5>
                                <?php } ?>                            
                                <div class="summary-wrapper"><?php echo $item->summary; ?></div>                        
                            </div>        
                        </div>
                    </div>
                     
                    <?php endforeach; //items ?>   
                <?php endforeach; //results ?>      
                    
                    
            
            <?php else : ?>
                
                <div class="">No items found.</div>
                
            <?php endif; ?>  
           
    </div>
</div>

<script>
jQuery(document).ready(function(){
	jQuery('.summary-wrapper').find('img').each(function(){
		var img = jQuery(this);
		if (!img.hasClass('img-responsive')) {
			img.addClass('img-responsive');
	    }
	});
});
</script>