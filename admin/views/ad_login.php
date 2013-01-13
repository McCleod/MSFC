<?php
    /*
    * Project:     Clan Stat
    * License:     Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
    * Link:        http://creativecommons.org/licenses/by-nc-sa/3.0/
    * -----------------------------------------------------------------------
    * Began:       2011
    * Date:        $Date: 2011-10-24 11:54:02 +0200 $
    * -----------------------------------------------------------------------
    * @author      $Author: Edd $
    * @copyright   2011-2012 Edd - Aleksandr Ustinov
    * @link        http://wot-news.com
    * @package     Clan Stat
    * @version     $Rev: 2.0.0 $
    *
    */
?>
<body style="height: 100% !important;">
<div style="height: 100%; width:100%;" align="center" class="ui-accordion-content ui-helper-reset ui-widget-content ui-accordion-content-active">
    <div style="height: 25%;"></div>
    <div>
       <img style="width:500px; height:89px;" src="../images/logo.png"/>
    </div>
    <div style="height: 5%;"></div>
    <div class="adinsider">
        <form action="<?=$_SERVER['PHP_SELF'];?>?auth" method="post">
            <table width="300px" border="0" cellspacing="4" cellpadding="0">
                <tr>
                    <td colspan="2" align="center">
                        <br>      
                    </td>
                </tr>
                <tr>
                    <td width="80" align="left">&nbsp;&nbsp;<?=$lang['log_login'];?>: </td>
                    <td align="left">
                    <input type="text" name="user" value="" maxlength="40"  />         </td>
                </tr>
                <tr>
                    <td width="80" align="left">&nbsp;&nbsp;<?=$lang['log_pass'];?>: </td>
                    <td align="left">
                    <input type="password" name="pass" value="" maxlength="40"  />          </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <br>      
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" name="login" value="<?=$lang['log_auth'];?>"  />      
                    </td>
                </tr>
            </table> 
        </form>
    </div>
</div>
<?php if ($auth->error()){ ?>
          <div align="center" class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active"
               style="position: absolute; width:100%; bottom: 0px;">
<?php     echo $auth->error(); ?>
          </div>
<?php }
      if (isset($data['msg'])){ ?>
          <div align="center" class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active"
               style="position: absolute; width:100%; bottom: 0px;">
<?php     echo '<br>'.error($data['msg']); ?>
          </div>
<?php }