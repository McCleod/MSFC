<?php
    /*
    * Project:     Clan Stat
    * License:     Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
    * Link:        http://creativecommons.org/licenses/by-nc-sa/3.0/
    * -----------------------------------------------------------------------
    * Began:       2011
    * Date:        $Date: 2011-10-24 11:54:02 +0200 $
    * -----------------------------------------------------------------------
    * @author      $Author: Edd, Exinaus, Shw  $
    * @copyright   2011-2012 Edd - Aleksandr Ustinov
    * @link        http://wot-news.com
    * @package     Clan Stat
    * @version     $Rev: 2.2.0 $
    *
    */
?>
<?php if($config['cron'] == 1 && $col_check > 2 && count($main_progress['main']) > 0){ ?>
    <div align="center">
    <table cellspacing="2" cellpadding="8" width="100%" class="ui-widget-content table-id-<?=$key;?>" style="border-width: 0; ">
            <tbody>
                <tr>
                    <td align="center" style="font-size: 15px;font-weight: bold;"><?=$lang['players_best_results'];?></td>
                    <td align="center" style="font-size: 15px;font-weight: bold;"><?=$lang['players_best_medals'];?></td>
                </tr>
                <tr>
                    <td valign="top" width="50%" align="center">
                        <?php if(time_summer($best_main_progress,'value') != 0){ ?>
                            <table id="best_main" cellspacing="1" width="100%">
                                <thead> 
                                    <tr>
                                        <th></th>
                                        <th><?=$lang['name']?></th> 
                                        <th><?=$lang['value']?></th>
                                    </tr>  
                                </thead>
                                <tbody>
                                    <?php foreach($best_main_progress as $name => $val){ ?> 
                                        <?php if($val['value'] != 0){ ?> 
                                            <tr> 
                                                <td><?=$lang[$name];?></td>
                                                <td><a href="<?php echo $config['base'].$val['name'].'/'; ?>" 
                                                    target="_blank"><?php echo $val['name']; ?></a></td>
                                                <td><?=$val['value'];?></td>
                                            </tr>
                                            <?php } ?>
                                        <?php } ?>
                                </tbody>  
                            </table>
                            <?php } ?>
                    </td>
                    <td valign="top" width="50%" align="center">
                        <?php if(time_summer($best_medal_progress,'value') != 0){ ?>
                            <table id="best_medal" cellspacing="1" width="100%">
                                <thead> 
                                    <tr>
                                        <th><?=$lang['achiv']?></th>
                                        <th><?=$lang['name']?></th> 
                                        <th><?=$lang['value']?></th>
                                    </tr>  
                                </thead>
                                <tbody>
                                    <?php foreach($best_medal_progress as $name => $val){ ?>  
                                        <?php if($val['value'] != 0){ ?>
                                            <tr> 
                                                <td class="bb" <?php echo 'title="<table width=\'100%\' border=\'0\'  class=\'ui-widget-content\' cellspacing=\'0\' cellpadding=\'0\'><tr><td><img src=\'./images/medals/'.ucfirst($name).'.png\' /></td><td><span align=\'center\' style=\'font-weight: bold;\'>'.$lang['medal_'.$name].'.</span><br> '.$lang['title_'.$name].'</td></tr></table>"';?>><?=$lang['medal_'.$name];?></td>
                                                <td><a href="<?php echo $config['base'].$roster_id[$val['account_id']]['account_name'].'/'; ?>" 
                                                    target="_blank"><?php echo $roster_id[$val['account_id']]['account_name']; ?></a></td>
                                                <td><?=$val['value'];?></td>
                                            </tr>
                                            <?php } ?>
                                        <?php } ?>
                                </tbody>  
                            </table>
                            <?php } ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php }else{ ?>
    <div class="num"><?=$lang['error_cron_off_or_none'];?></div>
    <?php } ?>