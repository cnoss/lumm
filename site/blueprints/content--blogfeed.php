<?php if(!defined('KIRBY')) exit ?>

title: Blogfeed (Contentvorlage)
pages: false
files: true
fields:
  info:
  	label: Blogfeed (Contentvorlage)
  	type: info
  	text: Hier werden die Blogeinträge gezeigt, die mit "Auf Startseite sichtbar" markiert sind. 
  	width: 1/2
  visible:
    label: Sichtbare Angaben
    type: headline
  title:
    label: Title/ Headline
    type:  text   
  invisible:
    label: Unsichtbare Angaben
    type: headline
  anzahl:
  	label: Anzahl der angezeigten Beiträge
  	type:  number