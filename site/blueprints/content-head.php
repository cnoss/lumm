<?php if(!defined('KIRBY')) exit ?>

title: Content Head
pages: false
files: true
fields:
  title:
    label: Title
    type:  text
  headline:
    label: Headline
    type:  textarea
  teasertext:
    label: Teaser
    type:  textarea
  layout:
    label: Layout
    type: radio
    options:
      design: Design
      architecture: Architecture
      photography: Photography
      3d: 3D
      web: Web