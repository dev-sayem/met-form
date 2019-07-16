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
        var_dump($value);
        ?>

        <label for="id">Form Name : </label>
        <input type="text" name="id" id="id" value="<?php echo (isset($value)) ? $value : ""; ?>"
            placeholer="Enter your Name" readonly/>

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

        $db_values = get_post_meta($post->ID, 'metform_entries__form_data', true);

        $values = (isset($db_values)) ? $db_values : "";

        foreach($values as $key=>$value){
            ?>
            <label for="<?php echo $key; ?>"><?php echo $key; ?> : </label>
            <input type="text" name="<?php echo $key; ?>" value="<?php echo $value; ?>">
            <br>
            <br>
            <?php
        }

    }

    function store_form_data_cmb($post_id){

        $form_data = $_POST;
        $form_id = get_post_meta($post_id, 'metform_entries__form_id', true);

        Action::instance()->store($form_id, $form_data,$post_id);
    }

    public function __construct()
    {
        $this->cpt = new Cpt();

        add_action('add_meta_boxes', [$this,'add_form_id_cmb']);

        add_action('add_meta_boxes', [$this,'add_form_data_cmb']);
        add_action('save_post', [$this,'store_form_data_cmb']);
    }

}