<?php if(!defined('KIRBY')) exit ?>

title: Artikelübersicht (Strukturvorlage)
pages:
  build:
	template:
    	-container--rows
		-container--main-sidebar
files: false
fields:
  info:
  	label: Artikelübersicht (Strukturvorlage)
  	type: info
  	text: Mit dieser Vorlage wird eine Artikelübersicht der enthaltenen Artikel erstellt.
  	width: 1/2
  visible:
    label: Sichtbare Angaben
    type: headline
  title:
    label: Title/ Headline
    type:  text
  text:
  	label: Content
  	type: textarea
  invisible:
    label: Unsichtbare Angaben
    type: headline
  keywords:
    label: Meta-Keywords
    type:  text
  desc:
    label: Meta-Description
    type:  text
  layout:
    label: Layout
    type: radio
    options:
      article-overview: Standard