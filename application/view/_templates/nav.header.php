    <!-- Fixed navbar -->
    <nav class="navbar info-color-dark navbar-default navbar-fixed-top z-depth-1" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="hidden navbar-brand waves-effect waves-light" href="<?php echo URL; ?>home/index">
	        <img alt="Brand" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAMAAAC7IEhfAAAA81BMVEX///9VPnxWPXxWPXxWPXxWPXxWPXxWPXz///9hSYT6+vuFc6BXPn37+vz8+/z9/f2LeqWMe6aOfqiTg6uXiK5bQ4BZQX9iS4VdRYFdRYJfSINuWI5vWY9xXJF0YJR3Y5Z4ZZd5ZZd6Z5h9apq0qcW1qsW1q8a6sMqpnLyrn76tocCvpMGwpMJoUoprVYxeRoJjS4abjLGilLemmbrDutDFvdLPx9nX0eDa1OLb1uPd1+Td2OXe2eXh3Ofj3+nk4Orl4evp5u7u7PLv7fPx7/T08vb08/f19Pf29Pj39vn6+fuEcZ9YP35aQn/8/P1ZQH5fR4PINAOdAAAAB3RSTlMAIWWOw/P002ipnAAAAPhJREFUeF6NldWOhEAUBRvtRsfdfd3d3e3/v2ZPmGSWZNPDqScqqaSBSy4CGJbtSi2ubRkiwXRkBo6ZdJIApeEwoWMIS1JYwuZCW7hc6ApJkgrr+T/eW1V9uKXS5I5GXAjW2VAV9KFfSfgJpk+w4yXhwoqwl5AIGwp4RPgdK3XNHD2ETYiwe6nUa18f5jYSxle4vulw7/EtoCdzvqkPv3bn7M0eYbc7xFPXzqCrRCgH0Hsm/IjgTSb04W0i7EGjz+xw+wR6oZ1MnJ9TWrtToEx+4QfcZJ5X6tnhw+nhvqebdVhZUJX/oFcKvaTotUcvUnY188ue/n38AunzPPE8yg7bAAAAAElFTkSuQmCC">
	      </a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
<?php // Dynamically create header menus...
$pages = array(
		'Home' => 'index',
		'Documentation' => 'documentation',
    	'Blog' => 'http://canchito-dev.com/public/blog/',
    	'github' => 'https://github.com/canchito-dev/'
);

foreach ($pages as $key => $value) {
?>
            <li><a href="<?php echo URL; ?>home/<?php echo $value; ?>"><strong><?php echo $key; ?></strong></a></li>
<?php } 

if($isLoggedIn) {
?>
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><strong>Collection</strong> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo URL; ?>songs/add">Add songs</a></li>
                <li><a href="<?php echo URL; ?>songs/listofsongs/1">List of songs</a></li>
              </ul>
            </li>
<?php } ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><strong>About Us</strong> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo URL; ?>home/whoweare">Who we are</a></li>
                <li><a href="<?php echo URL; ?>home/theteam">The team</a></li>
                <li><a href="<?php echo URL; ?>home/contactus">Contact us</a></li>
              </ul>
            </li>
          </ul>
<?php if(!$isLoggedIn) { ?>
			<div class="nav navbar-nav navbar-right">
				<a class="btn btn-default btn-sm navbar-btn" href="<?php echo URL; ?>home/signin" role="button">Sign In</a>
				<a class="btn btn-warning btn-sm navbar-btn" href="<?php echo URL; ?>home/register" role="button">Register</a>
			</div>
<?php } else { ?>
			<div class="nav navbar-nav navbar-right">
				<a class="btn btn-default btn-sm navbar-btn" href="<?php echo URL; ?>home/signout" role="button">Sign Out</a>
			</div>
<?php } ?>
        </div><!--/.nav-collapse -->
      </div>
    </nav>