<div class="well">
<form id="settings-form" role="form" method="post" class="form-horizontal clearfix">

    <div class="clearfix">
        <button type="submit" class="btn btn-primary pull-right">Save Changes</button>
    </div>
    
    <hr/>

    <div class="row">
        <div class="col-md-3 col-sm-4">
            <ul class="nav nav-pills nav-stacked">
                <li class="active">
                    <a href="#tab-home" data-toggle="tab"> Search </a>
                </li>
                <?php /* ?>
                <li>
                    <a href="#tab-general" data-toggle="tab"> General Settings </a>
                </li>
                */ ?>
                <?php if (!empty($this->event)) { foreach ((array) $this->event->getArgument('tabs') as $key => $title ) { ?>
                <li>
                    <a href="#tab-<?php echo $key; ?>" data-toggle="tab"> <?php echo $title; ?> </a>
                </li>
                <?php } } ?>                
            </ul>
        </div>

        <div class="col-md-9 col-sm-8">

            <div class="tab-content stacked-content">

                <div class="tab-pane fade in active" id="tab-home">
                    <h3 class="">Search Settings</h3>
                    <p class="help-block">The home view is the 'landing page' for your pages, available at <a href="./pages" target="_blank">/pages</a>.  It will include the latest pages from all your categories.</p>
                    <hr/>
                    
                    <div class="form-group">
                        <label class="control-label col-md-3">Include Categories Widget</label>
                        
                        <div class="col-md-7">
                            <select name="source">
                            <?php
							$options = array('text' => All, 'value' => 'all');
                            $sources = \Search\Factory::sources(); 
							foreach($sources as $source) {
								$options[] = array('text' => $source['title'], 'value' => $source['id']);
							}
                            ?>
                            <?php echo \Dsc\Html\Select::options($options , $flash->old('source'))?>
                            </select>
                        </div>
                    </div>

                </div>

                
                <?php if (!empty($this->event)) { foreach ((array) $this->event->getArgument('content') as $key => $content ) { ?>
                <div class="tab-pane fade in" id="tab-<?php echo $key; ?>">
                    <?php echo $content; ?>
                </div>
                <?php } } ?>

            </div>

        </div>
    </div>

</form>
</div>