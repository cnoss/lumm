<?php if(!defined('KIRBY')) exit ?>

title: Default
pages: 
  template:
    - content-head
    - content-body
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
  tags:
    label: Tags
    type: tags