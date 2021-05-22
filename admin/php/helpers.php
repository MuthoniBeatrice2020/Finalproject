<?php
    //input sanitation
    function validateFormData($form_data){
        $form_data= trim(stripcslashes(htmlspecialchars($form_data)));
        return $form_data;
    }
