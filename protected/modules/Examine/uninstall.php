<?
APP::Module('DB')->Open(APP::Module('Examine')->conf['connection'])->query('DROP TABLE examine');