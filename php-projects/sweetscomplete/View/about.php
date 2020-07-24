<?php
// get product details
require './Model/Products.php';
$productTable = new Products();
$titles = $productTable->getProductTitles(); 
?>
<div class="content">

	<div class="search left">
		<?php echo $view->searchForm($titles); ?>
	</div>

	<div class="intro left">
	  <h3>About Us</h3><br/>
	  <p>Lorem ipsum dolor sit amet consectetuer. Lorem ipsum dolor sit amet consectetuer, Lorem ipsum dolor sit amet consectetuer
	  Lorem ipsum dolor sit amet consectetuer. Lorem ipsum dolor sit amet consectetuer. Lorem ipsum dolor sit amet consectetuer.
	  </p>
	</div>
	<br class="clear"/>
	
	<div class="product-list">
	<table>
 	  <tr>
		<td width="50%">
		Suspendisse potenti. Donec commodo hendrerit arcu, vitae laoreet tortor scelerisque vestibulum. Nulla sem magna, aliquet quis semper vitae, 
		semper vel ligula. Proin condimentum tellus mattis leo varius dictum. In ornare iaculis enim. Donec sed tortor massa. Vivamus neque nulla, 
		sagittis nec facilisis id, porta ut nisl. Praesent ultricies leo dignissim sem sollicitudin dictum. Nullam ultricies augue iaculis mi 
		placerat adipiscing. Nullam pulvinar sem vel nibh egestas mollis. Fusce venenatis sodales velit, sit amet mollis diam vehicula at. 
		Fusce posuere lobortis arcu, nec mattis risus hendrerit non. Aenean luctus vestibulum eros eget lobortis. Proin nunc lorem, molestie ut 
		pulvinar a, ullamcorper non tortor. Proin ultrices justo quis lectus posuere convallis in eu elit.
		</td>
		<td width="50%">
		<img src="images/185_2577502.scale_20.JPG" width="360" height="240" />
		</td>
	  </tr>
	  <tr>
		<td width="50%">
		<img src="images/735_3633807.scale_20.JPG" width="360" height="240" />
		</td>
		<td width="50%">
		Aliquam a dui ut ligula iaculis dictum a eget dui. Suspendisse potenti. Pellentesque in elit laoreet risus tristique fermentum vel eget augue. 
		Sed id lacus ut ligula lacinia mattis. Aliquam eget blandit erat. Donec pretium tincidunt gravida. Praesent tincidunt imperdiet massa 
		convallis varius. Mauris a sollicitudin turpis. Cras nibh orci, commodo id cursus sed, facilisis sit amet dui. Sed quis ligula luctus 
		lacus aliquam imperdiet et et erat. Nunc eget augue quis lorem egestas mattis. Sed fermentum urna a tortor condimentum ac pellentesque 
		est euismod. Aliquam erat volutpat. Sed semper scelerisque lobortis.
		<br />
		Nam dolor arcu, sagittis sed molestie nec, cursus ut magna. Aenean euismod pellentesque massa ac auctor. Proin id hendrerit magna. 
		Etiam auctor hendrerit mollis. Fusce nec diam ut elit tempus semper. Phasellus dictum nibh nec tortor vestibulum egestas. In et mauris 
		dui. Donec dapibus massa ac tortor placerat nec placerat augue consectetur.
		</td>
	  </tr>
	</table>
	</div><!-- product-list -->

<br class="clear-all"/>
</div><!-- content -->
