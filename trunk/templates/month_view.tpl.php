<?php include 'header.tpl.php' ?>
<?php include 'common.tpl.php' ?>

<div id="pageWrapper">

  <h1 id="pagetitle">&nbsp;</h1>

  <div id="tabNav">
    <ul>
      <li><a href="month.php?y=<?=$this->y?>&m=<?=$this->m?>&d=<?=$this->d?>" class="current">Month View</a></li>
      <li><a href="week.php?y=<?=$this->y?>&m=<?=$this->m?>&d=<?=$this->d?>" >Week View</a></li>
      <li><a href="day.php?y=<?=$this->y?>&m=<?=$this->m?>&d=<?=$this->d?>" >Day View</a></li>
    </ul>
  </div>

  <h5 id="misclinks">Return to <a href="index.php">home page</a>&nbsp;|&nbsp;Today is: <a href="day.php?y=2005&m=03&d=23"><?php echo date('F d, Y') ?></a></h5>
  <h5 id="miscicons">
    <!--<a href="search.php"><img border="0" style="vertical-align: bottom; padding-bottom: 1px;" src="img/2/search.gif" width="13" height="13" 
                                  alt="Search this Calendar"> Search</a>-->
  </h5>

  <div id="heading" style="clear: both;">
    <div class="covermonth">&nbsp;</div>
    <a id="pageback" href="month.php?<?=$this->qbuild(date('Y m d', $this->prev_month))?>">
      <span style="font-size: 16px;">&laquo;</span>&nbsp;&nbsp; <?=date('M Y', $this->prev_month)?>
    </a>
    <a id="pagenext" href="month.php?<?=$this->qbuild(date('Y m d', $this->next_month))?>">
      <?=date('M Y', $this->next_month)?> &nbsp;<span style="font-size: 16px;">&raquo;</span>
    </a>
    <h1><?=date('F Y', $this->ts)?></h1>
  </div>

  <table class="calendar" cellpadding="0" cellspacing="1" border="0" width="100%">
    <tr>
      <?php foreach ($this->weekdays as $weekday): ?>
        <th width="14%"><?=$weekday?></th>
      <?php endforeach; ?>
    </tr>

<?php

        while ($day = $this->cur_month->fetch()) {

            $qbuild = $this->qbuild($day->thisYear(), $day->thisMonth(), $day->thisDay());

            if ($day->isFirst()) {
                echo '<tr>' . "\n";
            }

            if ($day->isEmpty()) { ?>

      <td class="notcurrentmonth" onClick="window.location='day.php?<?=$qbuild?>'">
        <img src="img/spacer.gif" border="0" width="1" height="100" align="left" />
        <img src="img/spacer.gif" border="0" width="1" height="100%" align="left" />
        <div class="daynumber"><?=$day->thisDay()?></div><em style="clear: right;"></em>
      </td>

<?php

            } else { 


?>


     <td class="<?=$day->thisDay(TRUE) == mktime(0,0,0, date('m'), date('d'), date('Y')) ? 'today' : ''?>" onClick="window.location='day.php?<?=$qbuild?>'">
     <img src="img/spacer.gif" border="0" width="1" height="100" align="left" />
     <img src="img/spacer.gif" border="0" width="1" height="100%" align="left" />

     <div class="daynumber"><?=$day->thisDay()?></div><em style="clear: right;"></em>

<?php

                if ($day->isSelected()) {

                    $events = $this->hash->get_events($day->thisDay());
                    $x = 0;

                    foreach ($events as $event) { 

                        if ($x == 3) { ?>

                        <div style="margin: 2px 0; padding: 2px; text-align: right;" class="text11">
                        <a href="day.php?<?=$qbuild?>">more...</a>
                        </div>
<?php
                            break;
                        }
?>

                    <div style="margin: 2px 0px; padding: 2px;" class="text11">
                            <img style="margin-right: 4px; float: left;" src="img/icons/<?=$event['iid']?>.gif" align="absmiddle">
                            <a href="viewevent.php?<?=$qbuild . '&id=' . $event['id']?>"><?=$event['title']?></a>
                        </div>

 
                         <?php $x++;

} 

                }
            
                echo '</td>';

            }

            if ($day->isLast()) {
                echo '</tr>' . "\n";
            }

        }

?>

    </table>

<?php include 'footer.tpl.php'; ?>