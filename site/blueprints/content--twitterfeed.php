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
    options:
      article: Standard
      article article--headline-outside: Headline außerhalb der Box
      article no-head: ohne Headline
      article article--close-head: Headline nah an Content