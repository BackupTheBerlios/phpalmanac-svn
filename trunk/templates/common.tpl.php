<div id="pickercal" class="calPicker"></div>

<div id="serviceBar">

  <?php /* calendar form */ ?>
  
  <form name="jumpform" id="jumpform" style="float: right; width: 200px;">
  
    <select name="smonth" style="width: 55px;">
      <?php echo $this->options($this->month_select, $this->m); ?>
    </select>
    
    <input type="hidden" name="sday" value="<?php echo $this->d; ?>">
    
    <select name="syear" style="width: 65px;">
      <?php echo $this->options(array_combine($this->year_select, $this->year_select), $this->y); ?>
    </select>
    
    <a href="javascript:toggleDatePicker('pickercal')">
      <img border="0" style="vertical-align: bottom; padding-bottom: 1px;" src="img/2/day.gif" width="22" height="20" 
           alt="Navigate quickly with the JavaScript Calendar /">
    </a>
    
    <img class="formbutton-left" style="* top: 2px;" src="img/2/button-left.gif" /><input type="button" name="jump" value="GO" 
         class="formbutton" style="width:40px;" onclick="location.href='index.php?y='+jumpform.syear.value+'&m='+jumpform.smonth.value+'&d='+jumpform.sday.value;" />
    
  </form>
  
  <?php /* PHP Almanac */ ?>
  
  <p style="padding-top: 8px; padding-left: 5px;"><a href="index.php" style="text-decoration: none">
    <img src="img/poweredby.gif" style="border: 0;" align="absmiddle" alt="Powered by PHP Almanac" title="Powered by PHPAlmanac" /> PHPAlmanac</a>
  </p>
           
</div>