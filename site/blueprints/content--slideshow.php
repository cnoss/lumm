<?php if(!defined('KIRBY')) exit ?>

title: Slideshow (Contentvorlage)
pages: false
files: true
fields:
  info:
  	label: Slideshow (Contentvorlage)
  	type: info
  	text: Die Bilder innerhalb dieser Vorlage werden hübsch als Slideshow angezeigt.
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
    width: 1/2
    options:
      slideshow__standard: Standard
      slideshow__headline_outside: Headline außerhalb der Box
  autostart:
    label: Slideshow automatisch starten?
    type: radio
    width: 1/2
    options:
      false: Nein
      true: Ja      
