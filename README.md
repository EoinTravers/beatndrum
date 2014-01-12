beatndrum
=========

Members' resources page for the Beat'n'Drum samba band.

Creating SQL Database
---
~~~
 CREATE TABLE `resources` (
  `type` varchar(99) DEFAULT NULL,
  `song` varchar(99) DEFAULT NULL,
  `url` varchar(999) DEFAULT NULL,
  `instruments` varchar(999) DEFAULT NULL,
  `uploader` varchar(99) DEFAULT NULL,
  `comments` varchar(999) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1
~~~
