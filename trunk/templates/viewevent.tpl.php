<?php include 'header.tpl.php' ?>
<?php include 'common.tpl.php' ?>

<div id="pageWrapper">

  <h1 id="pagetitle">&nbsp;</h1>

  <div id="tabNav">
    <ul>
      <li><a href="month.php?y=<?=$this->y?>&m=<?=$this->m?>&d=<?=$this->d?>">Month View</a></li>
      <li><a href="week.php?y=<?=$this->y?>&m=<?=$this->m?>&d=<?=$this->d?>">Week View</a></li>
      <li><a href="day.php?y=<?=$this->y?>&m=<?=$this->m?>&d=<?=$this->d?>" class="current">Day View</a></li>
    </ul>
  </div>

  <h5 id="misclinks">Return to <a href="index.php">home page</a>&nbsp;|&nbsp;Today is: <a href="day.php?y=2005&m=03&d=23"><?php echo date('F d, Y') ?></a></h5>
  <h5 id="miscicons">
    <!--<a href="search.php"><img border="0" style="vertical-align: bottom; padding-bottom: 1px;" src="img/2/search.gif" width="13" height="13" 
                                  alt="Search this Calendar"> Search</a>-->
  </h5>

  <div id="heading" style="clear: both;">
    <div class="coverday">&nbsp;</div>
    <h1><?=date('l F j, Y', $this->ts)?></h1>
  </div>


<?php

$tmp = format_time($this->data['time_start']) . ' - ' . format_time($this->data['time_end']);
$this->data['duration'] = $tmp == ' - ' ? '' : $tmp;

$info_points = array('title', 'duration', 'website', 'Details' => 'descrip');

?>

<table id="dayTable" cellpadding="0" cellspacing="0" width="100%" border="0">
<tr>
<td id="details">
<h1>Item Details</h1>
<div id="detailsWrapper" align="center">
<br />
<table cellpadding="0" cellspacing="5" border="0" style="text-align: left;" class="text11">

<?php

foreach ($info_points as $key => $val) {

    if (empty($this->data[$val])) {
        continue;
    }

    if (is_numeric($key)) {
        $key = ucwords($val);
    }
?>

<tr>
<th class="itemEditor" width="100" style="padding: 0px;"  valign="top"><?=$key?>:</th>
<th width="260" valign="top"><?=$this->data[$val]?></th>
</tr>

<?php } ?>

<tr>
<td colspan="2">
<ul class="eventActions">
</ul>
</td>
</tr>
<tr>
<td colspan="2" align="center">
<img class="formbutton-left" src="img/2/button-left.gif" /><input type="submit" name="sample" onclick="javascript: history.go(-1);" class="formbutton" value=" &laquo; Return " style="width: 80px;">
</td>
</tr>
</table>
<br style="clear: both;" />
</div>
</td>
</tr>
</table>