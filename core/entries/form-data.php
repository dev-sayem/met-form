<?php

namespace MetForm\Core\Entries;

Class Form_Data{

    function add_form_id_cmb()
    {
        add_meta_box(
            'metform_entries__form_id',
            'Form ID',
            [$this,'show_form_id_cmb'],
            $this->cpt->get_name(),
            'normal',
            'high'
        );
    }

    function show_form_id_cmb($post)
    {
        // Add a nonce field so we can check for it later.
        wp_nonce_field('meta_nonce', 'meta_nonce');

        $value = get_post_meta($post->ID, 'metform_entries__form_id', true);
        ?>

        <label for="id">Form ID : </label>
        <input type="text" name="id" id="id" value="<?php echo (isset($value)) ? $value : ""; ?>"
            placeholer="Enter your Name"/>

        <?php
    }

    function add_form_data_cmb()
    {
        add_meta_box(
            'metform_entries__form_data',
            'Form Data',
            [$this,'show_form_data_cmb'],
            $this->cpt->get_name(),
            'normal',
            'high'
        );
    }

    function show_form_data_cmb($post)
    {
        // Add a nonce field so we can check for it later.
        wp_nonce_field('meta_nonce', 'meta_nonce');

        $value = get_post_meta($post->ID, 'metform_entries__form_data', true);
        ?>

        <label for="data">Form Data : </label>
        <textarea name="data" id="data" cols="30" rows="10"><?php echo (isset($value)) ? $value : ""; ?></textarea>
        <!-- <input type="text" name="user_name" id="user_name" value="<?php echo (isset($value)) ? $value : ""; ?>"
            placeholer="Enter your Name"/> -->

        <?php
    }

    public function __construct()
    {
        $this->cpt = new Cpt();

        add_action('add_meta_boxes', [$this,'add_form_id_cmb']);
        //add_action('save_post', [$this,'store_form_id_cmb']);

        add_action('add_meta_boxes', [$this,'add_form_data_cmb']);
        //add_action('save_post', [$this,'store_form_data_cmb']);
    }

}