	<?php 
    include 'functions.php';
    printHeader();
	$tagval = $_GET["tag"]; ?>
  
            <div id="content" style="float:left;width:930px;">
	            <div itemscope="" itemtype="http://schema.org/Article">
           	      <div id="Badge-header">
            		<h1 class="custom_h" itemprop="name" style="text-align:center;"><?php echo $tagval; ?></h1>
                    </div>
                    <div id="TagDetails" style="float:left;position:relative;
left:0;">
                    <div id="Answered List">
                    	<p>Answered Questions</p>
                    	<ul class="list">
                        <?php 
                          
                          GetQuestionsForTag($tagval,1,6);
                        ?> 	
                      </ul>
                    </div>
                    <div id="Unanswered List" style="">
                    	<p>Unanswered Questions</p>
                    	<ul class="list">
                        <?php
						 
                          	GetQuestionsForTag($tagval,0,6);
                        ?> 
                        </ul>
                    </div>
                    </div>
                    <div id="sidebar" style="float:right;">
                    <div class="module newuser newuser-greeting" id="newuser-box" style="">
                    	  <p>Top Users</p>
                        <div>
                            <ul class="list">
                            	<?php
                                    GetUsersForTag($tagval,6);
                                ?> 
                            </ul>
                        </div>
                    </div>
                    </div>
                    </div>

<?php printFooter(); ?>
