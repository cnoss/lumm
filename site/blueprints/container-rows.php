<?php if(!defined('KIRBY')) exit ?>

title: Komplette Spalte (Container)
pages:
	template:
    -container-main-sidebar
    -container-rows
    -content-article
    -content-slideshow
files: false
fields:
  info:
  	label: Komplette Spalte (Container)
  	type: info
  	text: Mit dieser Vorlage werden alle Subpages alles Reihen über die komplette Breite dargestellt. Subpages dürfen Struktur- oder Contentvorlagen benutzen.
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