/**
 * Dynamically loads Marketo forms based on the
 * settings provided.
 */
define([
    "jquery",
    "marketojs"
    ],
    function($, marketoJS) {
        "use strict";
        return function(config, element) {
            MktoForms2.loadForm(config.base_url, config.munchkin_id, config.form_id);
        }
    }
);