<?php if(!defined('KIRBY')) exit ?>

title: Instafeed (Contentvorlage)
pages: false
files: true
fields:
  info:
  	label: Instafeed (Contentvorlage)
  	type: info
  	text: Hier werden die Bilder von instagram gezeigt. Die Angaben zum instagram Account müssen in den Seitenvariabeln gepflegt werden. 
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
  filter_tags:
  	label: Tags (optional)
  	type: text
  	help: 
      de: Filter-Tags für den Feed
