<?php if(!defined('KIRBY')) exit ?>

title: Page
pages:
	template:
    - blogentry
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
  layout:
    label: Layout
    type: radio
    options:
      blogentry-1row: große Einträge 