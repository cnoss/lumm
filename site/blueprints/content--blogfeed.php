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
  text:
  	label: Content
  	type: textarea
  invisible:
    label: Unsichtbare Angaben
    type: headline
  anzahl:
  	label: Anzahl der angezeigten Beiträge
  	type:  number
  filter:
    label: Nur Einträge mit Tags
    type: tags
  ruler:
    label: Trenner anzeigen
    type: radio
    width: 1/2
    options:
      no-ruler: nein
      ruler: ja 
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
  layout:
    label: Layout von Headline und Teaser
    type: radio
    options:
      article: Standard
      article article--headline-outside: Headline außerhalb der Box
      headline-only: Nur Headline
      part-of-content: in Content integriert
      no-head: ohne