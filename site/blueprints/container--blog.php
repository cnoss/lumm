<?php if(!defined('KIRBY')) exit ?>

title: Blog (Strukturvorlage)
pages:
	template:
    -content--blogentry
	num: date
	visible: true
files: false
fields:
  info:
  	label: Blog (Strukturvorlage)
  	type: info
  	text: Mit dieser Vorlage werden alle Blogeinträge(Subpages) als Reihen über die komplette Breite dargestellt.
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
  keywords:
    label: Meta-Keywords
    type:  text
  desc:
    label: Meta-Description
    type:  text