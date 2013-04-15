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
            		<h1 itemprop="name" style="text-align:center;">
						<?php
                            echo $badgeval;
                        ?>
					</h1>
                    </div>
                    <div id="BadgeList" style="float:left;">
                    	<h4 >User List For Scholar Badge</h4>
                    	<ul class="list">
                        	<?php 
                                GetTopUsersForBadges($badgeval,10);
                            ?> 
                        </ul>
                    </div>
                    <div id="sidebar" style="float:right;">
                        <h4 >Top Locations for Scholar Badge</h4>
                        <ul class="list">
                            <?php 
                                GetTopLocationsForBadges($badgeval,10);
                            ?>
                        </ul>        
                    </div>
                </div>
		    </div>
        <?php printFooter(); ?>
