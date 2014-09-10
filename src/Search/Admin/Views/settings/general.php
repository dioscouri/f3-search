<div class="row">
    <div class="col-md-12">

        <div class="form-group">
            <div class="row">
                <div class="col-md-4">        
                    <label>Default Front-End Type:</label>
                    <select name="default_site_type" class="form-control">
                        <?php foreach (\Search\Factory::sources() as $source) { ?>
                        <option value="<?php echo $source['id']; ?>" <?php echo ($flash->old('default_site_type') == $source['id']) ? "selected='selected'" : null; ?>><?php echo $source['title']; ?></option>
                        <?php } ?>
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
                        <?php foreach (\Search\Factory::sources() as $source) { ?>
                        <option value="<?php echo $source['id']; ?>" <?php echo ($flash->old('default_admin_type') == $source['id']) ? "selected='selected'" : null; ?>><?php echo $source['title']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <!-- /.form-group -->
                
    </div>
</div>