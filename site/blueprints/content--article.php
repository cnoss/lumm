<?php if(!defined('KIRBY')) exit ?>

title: Artikel (Contentvorlage)
pages: false
files: true
fields:
  info:
  	label: Artikel (Contentvorlage)
  	type: info
  	text: Die Inhalte dieser Vorlage werden hübsch als Artikel angezeigt.
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
  autor:
  	label: Autor
  	type: text
  	icon: user
  	width: 1/2
  date:
    label: Date
    type: date
    format: YYYY-MM-DD
    width: 1/2
  layout:
    label: Layout
    type: radio
    options:
      article: Standard
      article article--headline-outside: Headline außerhalb der Box
      article no-head: ohne Headline
      article no-head gap-at-top: ohne Headline mit Abstand von oben
  home:
    label: Sichtbar auf Startseite
    type: radio
    width: 1/2
    options:
      false: Nein
      true: Ja