<div class="container">
    <div id="content-header">
        <h1>Search</h1>
    </div>

    <div class="row">
        <aside class="col-sm-2 col-md-2">
            <ul class="nav nav-pills nav-stacked">
            <li class="active"><a href="./search?q=<?php echo $q; ?>">
                        <span class="badge pull-right"><?php echo count($results); ?></span>
                        All
                    </a></li>
                <?php foreach (\Search\Factory::sources() as $source) { ?>
                <li  ">
                    <a href="./search?q=<?php echo $q; ?>&filter[search]=<?php echo $source['id']; ?>">
                        <span class="badge pull-right"><?php echo \Search\Models\Source::count( $source, $q ); ?></span>
                        <?php echo $source['title']; ?>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </aside>
        <div class="col-sm-10 col-md-10">

            <div class="row">
                <div class="col-md-12">
                    <form method="get" action="/search" role="search">
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
               	<h2><?php echo $type; ?></h2>
               		<?php foreach($items as $model_item) : ?>
               		<?php $item = $model_item->toSearchItem();?>
               		 <div class="row">

                        <div class="col-md-3">
                            <?php if ($item->image) { ?>
                            <a href="<?php echo $item->url; ?>">
                                <img src="<?php echo $item->image; ?>" class="img-responsive" />
                            </a>
                            <?php } ?>
                        </div>
                        <div class="col-md-9">
                            <a href="<?php echo $item->url; ?>">
                                <h3><?php echo $item->title; ?></h3>
                                <?php if (!empty($item->subtitle)) { ?>
                                <h4><?php echo $item->subtitle; ?></h4>
                                <?php } ?>
                                <div class="summary-wrapper"><?php echo $item->summary; ?></div>
                            </a>
                        </div>
        
                    </div>
        
                    <hr />
               	
               	
               	
               		<?php endforeach; //items ?>   
               <?php endforeach; //results ?>      
                    
                    
            
            <?php else : ?>
                
                <div class="">No items found.</div>
                
            <?php endif; ?>            
        </div>
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