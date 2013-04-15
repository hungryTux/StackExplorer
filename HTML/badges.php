    <?php 
    include 'functions.php';
    include 'urlHandler.php';

    $handler = new UrlHandler($_GET); 
    $badgeval = $handler->get_var("badge"); 

    printHeader();

    ?>

    	<div class="container" style="width:990px;">
            <div id="content" style="float:left;width:930px;">
	            <div itemscope="" itemtype="http://schema.org/Article">
            	    <div id="Badge-header">
            		<h1 class="custom_h" style="text-align:center;">
						<?php
                            echo $badgeval;
                        ?>
					</h1>
                    </div>
                    <div id="BadgeList" style="float:left;">
                    	<?php print '<h4 class="custom_h">User List for \''.$badgeval.'\' Badge</h4>' ?>
                    	<ul class="list">
                        	<?php 
                                GetTopUsersForBadges($badgeval,10);
                            ?> 
                        </ul>
                    </div>
                    <div id="sidebar" style="float:right;">
                        <?php print '<h4 class="custom_h">Top Locations for \''.$badgeval.'\' Badge</h4>' ?>
                        <ul class="list">
                            <?php 
                                GetTopLocationsForBadges($badgeval,10);
                            ?>
                        </ul>        
                    </div>
                </div>
		    </div>
        <?php printFooter(); ?>
