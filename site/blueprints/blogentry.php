<?php if(!defined('KIRBY')) exit ?>

title: Page
pages: false
files: true
fields:
  title:
    label: Title
    type:  text
  keywords:
    label: Meta-Keywords
    type:  text
  desc:
    label: Meta-Description
    type:  text
  text:
  	label: Content
  	type: textarea 
  tags:
    label: Tags
    type: tags