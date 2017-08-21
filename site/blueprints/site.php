<?php if(!defined('KIRBY')) exit ?>

title: Site
pages: 
	template: 
		container--rows
		container--main-sidebar
		container--blog
fields:
  visible_section:
    label: Sichbare Angaben
    type: headline
  title:
    label: Title
    type:  text
  subheadline:
    label: Subheadline
    type:  text
  author:
    label: Author
    type:  text
  copyright:
    label: Copyright
    type:  text
       
  invisible_section:
    label: Meta Angaben
    type: headline
  description:
    label: Description
    type:  textarea
  keywords:
    label: Keywords
    type:  tags

  contact_section:
    label: Kontaktdaten
    type: headline
  adress:
    label: Adresse
    type:  textarea
  email: 
  	label: E-Mail Adresse (wird etwas SPAM-sicherer gemacht)
  	type: text
  contact:
  	label: Kontaktdaten
  	type: textarea
  social:
  	label: Social Networks
  	type: textarea
  	
  instagram_section:
    label: Instagram
    type: headline
  userId:
  	label: User ID
  	type: text
  accessToken:
  	label: Access Token
  	type: text
  clientId:
  	label: Client ID
  	type: text