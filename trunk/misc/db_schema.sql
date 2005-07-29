CREATE TABLE `phpa_main` (
  `ID` smallint(4) unsigned NOT NULL auto_increment,
  `IID` tinyint(2) unsigned NOT NULL default '1',
  `title` varchar(30) NOT NULL default '',
  `descrip` varchar(100) NOT NULL default '',
  `due_date` date NOT NULL default '0000-00-00',
  `add_date` int(10) unsigned NOT NULL default '0',
  `time_start` time NOT NULL default '00:00:00',
  `time_end` time NOT NULL default '00:00:00',
  `contact_name` varchar(30) NOT NULL default '',
  `contact_email` varchar(40) NOT NULL default '',
  `website` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
