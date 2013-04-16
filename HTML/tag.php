<?php 
    include 'functions.php';
    $tagval = $_GET["tag"]; 
    printHeader();
?> 
        <div class="container" style="">
            <div id="Tag-header">
                <h1 itemprop="name" style="text-align:center;">
                    <?php 
                        echo $tagval; 
                    ?>
                </h1>
            </div>
            <div id="content" style="">
                <div id="TagDetails" style="float:left;">
                    <div id="Answered List" style="">
                        <h3 style="text-align:center;">Favourite Answered Questions</h3>
                        <ul style="">
                            <?php 
                                GetQuestionsForTag($tagval,1,11);
                            ?>  
                        </ul>
                    </div>
                    <div id="Unanswered List" style="">
                        <h3 style="text-align:center;">Favourite Unanswered Questions</h3>
                        <ul style="">
                            <?php
                                GetQuestionsForTag($tagval,0,11);
                            ?> 
                        </ul>
                    </div>
                </div>
                <div id="sidebar" style="float:right; width:30%;">
                    <div class="module newuser newuser-greeting" id="newuser-box" style="">
                        <h3 style="text-align:center;">Top Users</h3>
                        <div>
                            <ul style="">
                                <?php
                                    GetUsersForTag($tagval,11);
                                ?> 
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php                     
    printFooter();
?> 