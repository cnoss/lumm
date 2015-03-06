<?php if(!defined('KIRBY')) exit ?>

title: Hauptspalte mit Sidebar (Container)
pages:
  build:
    - title: Hauptspalte
      uid: hauptspalte
      template: container--rows
      num: 1
    - title: Sidebar
      uid: sidebar
      num: 2
      template: container--rows
files: false
fields:
  info:
  	label: Hauptspalte mit Sidebar (Container)
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
  headline_zeigen:
    label: Headline zeigen
    type: radio
    width: 1/2
    options:
      false: Nein
      true: Ja         