<?php
        require_once 'urlHandler.php';
        require_once 'functions.php';

        $handler = new UrlHandler($_GET);
        $postId = $handler->get_var('postId');

        $array=getPost($postId);
?>

    <?php 
        printHeader(); 
    ?>

    <div id="content" style="margin: 0 auto;width: 960px; min-height: 450px">
      <div id="post_title" style="font-family: Trebuchet MS,Liberation Sans,DejaVu Sans,sans-serif;width: 960px;margin-bottom: 20px;">
        <h1><?php echo $array[0] ?></h1>
      </div>
      <div id="mainpost" style="float: left;margin-bottom: 40px; width: 735px;">
        <div id="question" style="clear: both; width: 728px;">
          <table>
            <tbody>
              <tr>
                <td style="width: 60px;vertical-align: top;"><h2>Q:<h2></td>
                <td style="margin: 0;padding: 0;border: 0;font-size: 100%;vertical-align: baseline;background: transparent;">
                  <div style="margin: 0;padding: 0;border: 0; vertical-align: baseline;background: transparent;">
                    <?php echo $array[1] ?>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div id="answer" style="clear: both;padding-top: 10px;width: 728px;">
          <div id="answer-header" style="width: 728px;margin-top: 10px;margin-bottom: 10px;">
            <div style="border-bottom: 1px solid #cccccc;height: 54px;clear: both;">
              <h2 style="float: left;font-size: 22px;line-height: 34px;margin-bottom: 0px;"> Accepted Answer </h2>
            </div>
          </div>
          <div id="answer-text" style="width: 728px;padding-bottom: 20px;padding-top: 20px;">
            <table>
              <tbody>
                <tr>
                  <td style="width: 60px;vertical-align: top;"></td>
                  <td id="answercell" style="width: 660px;font-size: 107%;margin-bottom: 5px;margin-right: 5px;line-height: 130%;">
                    <?php echo $array[2] ?>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
      </div>
    </div>

  </body>

</html>


