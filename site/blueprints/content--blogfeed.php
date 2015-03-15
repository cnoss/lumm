<?php if(!defined('KIRBY')) exit ?>

title: Artikelstrom (Contentvorlage)
pages: false
files: true
fields:
  info:
  	label: Artikelstrom (Contentvorlage)
  	type: info
  	text: Hier werden die Artikel oder Artikelvorschauen gezeigt. 
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
  type:
    label: Art der Artikel
    type: radio
    width: 1/2
    options:
      home: Startseitenbeiträge
      blog: Blogbeiträge 
  type_of_layout:
    label: Art der Darstellung
    type: radio
    options:
      complete: Komplett
      complete--hero: Komplett mit viel Platz drumherum 
      excerpt: Auszug