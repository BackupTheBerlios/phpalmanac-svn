CREATE TABLE `phpa_main` (
  `ID` smallint(4) unsigned NOT NULL auto_increment,
  `IID` tinyint(2) unsigned NOT NULL default '1',
  `title` varchar(30) NOT NULL default '',
  `descrip` varchar(30) NOT NULL default '',
  `due_date` date NOT NULL default '0000-00-00',
  `add_date` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
