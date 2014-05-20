<?php
class Attachment extends AppModel {

    public $uses  = array('User','Bar','Attachment','Meeting');

    public $actsAs = array(
        'Upload.Upload' => array(
            'photo_user' => array(
                'thumbnailSizes' => array(
                    'thumb150' => '150x150',
                    'thumb250' => '250x250',
                    'thumb300' => '300x300',
                    'thumb350*250' => '350x250',
                    'thumb350' => '350x350',
                    'thumb400*200' => '400x200',
                    'thumb400*300' => '400x300',
                    'thumb400' => '400x400',
                    'thumb438*350' => '438x350', 
                    'thumb438' => '438x438', 
                    'thumb626' => '626x626',                    
                ),
                'thumbnailMethod' => 'php',
                'fields' => array('dir' => 'dir', 'type' => 'type', 'size' => 'size'),
                'mimetypes' => array('image/jpeg', 'image/gif', 'image/png'),
                'extensions' => array('jpg', 'jpeg', 'JPG', 'JPEG', 'gif', 'GIF', 'png', 'PNG'),
                'maxSize' => 2097152, //2MB
            ),
            'photo_bar' => array(
                'thumbnailSizes' => array(
                    'thumb150' => '150x150',
                    'thumb250' => '250x250',
                    'thumb300' => '300x300',
                    'thumb350*250' => '350x250',
                    'thumb350' => '350x350',
                    'thumb400*200' => '400x200',
                    'thumb400*300' => '400x300',
                    'thumb400' => '400x400',
                    'thumb438*350' => '438x350', 
                    'thumb438' => '438x438', 
                    'thumb626' => '626x626',        
                ),
                'thumbnailMethod' => 'php',
                'fields' => array('dir' => 'dir', 'type' => 'type', 'size' => 'size'),
                'mimetypes' => array('image/jpeg', 'image/gif', 'image/png'),
                'extensions' => array('jpg', 'jpeg', 'JPG', 'JPEG', 'gif', 'GIF', 'png', 'PNG'),
                'maxSize' => 2097152, //2MB
            ),
        ),
    );


    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'foreign_key',
        ),

        'Bar' => array(
            'className' => 'Bar',
            'foreignKey' => 'foreign_key',
        ),
    );
}
?>