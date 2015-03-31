<div class="row">
    <div class="col-md-12">
		 <?php
			$options[] = array('text' => 'All', 'value' => 'all');
            $sources = \Search\Factory::sources(); 
			foreach($sources as $source) {
					$options[] = array('text' => $source['title'], 'value' =>(string) $source['id']);
			}
         ?>
    
    
        <div class="form-group">
            <div class="row">
                <div class="col-md-4">        
                    <label>Default Front-End Type:</label>
                    <select name="default_site_type" class="form-control">
                     <?php  echo \Dsc\Html\Select::options($options , $flash->old('default_site_type'))?>
                    </select>
                </div>
            </div>
        </div>
        <!-- /.form-group -->
        
        <hr/>
                
        <div class="form-group">
            <div class="row">
                <div class="col-md-4">        
                    <label>Default Admin Type:</label>
                    <select name="default_admin_type" class="form-control">
                    <?php  echo \Dsc\Html\Select::options($options , $flash->old('default_admin_type'))?>
                    </select>
                </div>
            </div>
        </div>
        <!-- /.form-group -->
                
    </div>
</div>