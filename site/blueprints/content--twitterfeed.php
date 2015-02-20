<?php if(!defined('KIRBY')) exit ?>

title: Twitterfeed (Contentvorlage)
pages: false
files: true
fields:
  info:
  	label: Twitterfeed (Contentvorlage)
  	type: info
  	text: Hier werden die Tweets von Twitter gezeigt. Die Angaben zum twitter Account müssen in den Seitenvariabeln gepflegt werden. 
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
  layout:
    label: Layout
    type: radio
    width: 1/2
    options:
      article__standard: Standard
      article__headline_outside: Headline außerhalb der Box