<h3 class="">Search Settings</h3>
<hr />

<div class="">

   
    
    <div class="form-group">
        <label>Source</label>
        
         <div class="col-md-7">
                            <select name="search[source]">
                            <?php
							$options[] = array('text' => 'All', 'value' => 'all');
                            $sources = \Search\Factory::sources(); 
							foreach($sources as $source) {
								$options[] = array('text' => $source['title'], 'value' =>(string) $source['id']);
							}
                            ?>
                            <?php  echo \Dsc\Html\Select::options($options , $flash->old('search.source'))?>
                            </select>
                                                       
                        </div>
    </div>
    <!-- /.form-group -->
        
</div>