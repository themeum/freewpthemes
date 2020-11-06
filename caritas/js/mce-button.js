// jQuery(document).ready(function($){
//     'use strict';
//
//     /*========================================================================
//      * caritas WP Editor Button
//      *======================================================================== */
//
//     tinymce.PluginManager.add('caritas_button', function( editor, url ) {
//         editor.addButton( 'caritas_button', {
//             text: 'Caritas ShortCode',
//             icon: false,
//             type: 'menubutton',
//             menu: [
//                 {
//                     text: 'Donation Button',
//                     onclick: function() {
//                         editor.insertContent('[themeum_donate currency="USD:$" paypalid="Paypal ID here" target="_blank" more="true" amount1="25" amount2="50" btn_name="Donate Now"]');
//                     }
//                 }
//             ]
//         });
//     });
//
// });


(function() {
    tinymce.PluginManager.add('mybutton', function( editor, url ) {
        editor.addButton( 'mybutton', {
            text: tinyMCE_object.button_title,
            icon: false,
            onclick: function() {
                editor.windowManager.open( {
                    title: tinyMCE_object.button_title,
                    body: [
                        {
                            type: 'textbox',
                            name: 'currency',
                            label: tinyMCE_object.currency,
                            value: 'USD:$',
                        },
                        {
                            type: 'textbox',
                            name: 'paypalid',
                            label: tinyMCE_object.paypalid,
                            value: 'Paypal ID here',
                        },
                        {
                            type: 'textbox',
                            name: 'target',
                            label: tinyMCE_object.target,
                            value: '_blank',
                        },
                        {
                            type: 'textbox',
                            name: 'more',
                            label: tinyMCE_object.more,
                            value: 'true',
                        },
                        {
                            type: 'textbox',
                            name: 'amount1',
                            label: tinyMCE_object.amount1,
                            value: '25',
                        },
                        {
                            type: 'textbox',
                            name: 'amount2',
                            label: tinyMCE_object.amount2,
                            value: '50',
                        },
                        {
                            type: 'textbox',
                            name: 'amount3',
                            label: tinyMCE_object.amount3,
                            value: '100',
                        },
                        {
                            type: 'textbox',
                            name: 'amount4',
                            label: tinyMCE_object.amount4,
                            value: '500',
                        },
                        {
                            type: 'textbox',
                            name: 'btn_name',
                            label: tinyMCE_object.btn_name,
                            value: 'Donate Now',
                        },
                        {
                            type: 'textbox',
                            name: 'class',
                            label: tinyMCE_object.class,
                            value: '',
                        },
                    ],
                    onsubmit: function( e ) {
                        editor.insertContent( '[themeum_donate currency="'+ e.data.currency +'" paypalid="'+ e.data.paypalid +'" target="'+ e.data.target +'" more="'+ e.data.more +'" amount1="'+ e.data.amount1 +'" amount2="'+ e.data.amount2 +'"  amount3="'+ e.data.amount3 +'" amount4="'+ e.data.amount4 +'" class="'+ e.data.class +'" ]');
                    }
                });
            },
        });
    });

})();