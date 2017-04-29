    <!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <h1>List of Songs</h1>
      </div>
      <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
	  	<br></br>
	  		<table class="table table-striped table-bordered table-hover table-condensed">
		        <thead>
			        <tr>
			            <th class="text-center">Id</th>
			            <th class="text-center">Artist</th>
			            <th class="text-center">Track</th>
			            <th class="text-center">Link</th>
			            <th class="text-center"></th>
			        </tr>
		        </thead>
		        <tbody>
		        	<?php foreach ($songs as $song) { ?>
	                <tr>
	                    <td><?php if (isset($song['id'])) echo htmlspecialchars($song['id'], ENT_QUOTES, CHARSET); ?></td>
	                    <td><?php if (isset($song['artist'])) echo htmlspecialchars($song['artist'], ENT_QUOTES, CHARSET); ?></td>
	                    <td><?php if (isset($song['track'])) echo htmlspecialchars($song['track'], ENT_QUOTES, CHARSET); ?></td>
	                    <td>
	                        <?php if (isset($song['link'])) { ?>
	                            <a href="<?php echo htmlspecialchars($song['link'], ENT_QUOTES, CHARSET); ?>"><?php echo htmlspecialchars($song['link'], ENT_QUOTES, CHARSET); ?></a>
	                        <?php } ?>
	                    </td>
	                    <td>
	                    	<div class="btn-toolbar" role="toolbar">
							  <div class="btn-group btn-group-xs" role="group">
							  	<a class="btn btn-default" href="<?php echo URL . 'songs/deletesong/' . htmlspecialchars($song['id'], ENT_QUOTES, CHARSET); ?>" role="button" title="Delete">
							  		<span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
							  	</a>
							  	<a class="btn btn-default" href="<?php echo URL . 'songs/editsong/' . htmlspecialchars($song['id'], ENT_QUOTES, CHARSET); ?>" role="button" title="Edit">
							  		<span class="glyphicon glyphicon glyphicon-pencil" aria-hidden="true"></span>
							  	</a>
							  </div>
							</div>
	                    </td>
	                </tr>
	            	<?php } ?>
		        </tbody>
		    </table>
			<!-- Pagination -->
<?php echo $pagination->renderBootstrapV3(); ?>
			<!-- /Pagination -->
		<br></br>
    </div>