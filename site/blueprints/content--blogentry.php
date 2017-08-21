<?php if(!defined('KIRBY')) exit ?>

title: Blogentry (Contentvorlage)
pages: false
files: true
fields:
  info:
  	label: Blogentry (Contentvorlage)
  	type: info
  visible:
    label: Sichtbare Angaben
    type: headline
  title:
    label: Title/ Headline
    type:  text
  text:
  	label: Content
  	type: textarea 
  tags:
    label: Tags
    type: tags
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
    width: 1/2
    options:
      blogentry: Standard
      blogentry blogentry--focussed: Hervorgehoben
  home:
    label: Sichtbar auf Startseite
    type: radio
    width: 1/2
    options:
      false: Nein
      true: Ja      