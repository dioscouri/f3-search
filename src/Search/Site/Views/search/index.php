<div class="container">
    <div id="content-header">
        <h1>Search</h1>
    </div>

    <div class="row">
        <aside class="col-sm-2 col-md-2">
            <ul class="nav nav-pills nav-stacked">
                <?php foreach (\Search\Factory::sources() as $source) { ?>
                <li class="<?php if ($current_source['id'] == $source['id']) { echo ' active'; } ?>">
                    <a href="/search?q=<?php echo $q; ?>&filter[search]=<?php echo $source['id']; ?>"><?php echo $source['title']; ?></a>
                </li>
                <?php } ?>
            </ul>
        </aside>
        <div class="col-sm-10 col-md-10">

            <div class="row">
                <div class="col-md-12">
                    <form method="get" action="/search?filter[search]=<?php echo $current_source['id']; ?>" role="search">
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
                    
            <?php if (!empty($paginated->items)) { ?>
            
                <?php // This enables filter.type-specific overrides.  Products one layout, blog posts another, etc ?>
                <?php if ($view_file = $this->findViewFile( 'Search/Site/Views::search/' . $current_source['id'] . '.php' )) {
                    $this->paginated = $paginated; 
                	echo $this->renderView( 'Search/Site/Views::search/' . $current_source['id'] . '.php' );
                } else { ?>            
            
                <div class="main-bottom">
                    <div class="half text-left">
                        <div class="page-counter pull-left">
                            <div class="type-selector">
                                <span class="pagination">
                                    <?php echo (!empty($paginated->total_pages)) ? $paginated->getResultsCounter() : null; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="half text-right">
                        <?php if (!empty($paginated->total_pages) && $paginated->total_pages > 1) { ?>
                            <?php echo $paginated->serve(); ?>
                        <?php } ?>
                    </div>
                </div>            
            
                <?php foreach ($paginated->items as $position=>$model_item) { ?>
                    <?php if ($item = $model_item->toSearchItem()) { ?>
                        
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
                                <div><?php echo $item->summary; ?></div>
                            </a>
                        </div>
        
                    </div>
        
                    <hr />
                         
                    <?php }?>
                <?php } ?>
                
                <div class="main-bottom">
                    <div class="half text-left">
                        <div class="page-counter pull-left">
                            <span class="pagination">
                                <?php echo (!empty($paginated->total_pages)) ? $paginated->getResultsCounter() : null; ?>
                            </span>             
                        </div>
                    </div>
                    <div class="half text-right">
                        <?php if (!empty($paginated->total_pages) && $paginated->total_pages > 1) { ?>
                            <?php echo $paginated->serve(); ?>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            
            <?php } else { ?>
                
                <div class="">No items found.</div>
                
            <?php } ?>            
        </div>
    </div>
</div>
